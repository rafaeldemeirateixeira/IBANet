<?php

require_once 'src/ReCaptcha/ReCaptcha.php';
require_once 'src/ReCaptcha/RequestMethod.php';
require_once 'src/ReCaptcha/RequestMethod/Post.php';
require_once 'src/ReCaptcha/RequestParameters.php';
require_once 'src/ReCaptcha/Response.php';

class LoginController extends DeiaController
{

    protected $privatekey = "6LeruwMTAAAAAG6Ggmuk3fTuO3wMDG151yBHHhOx";
    protected $publickey = "6LeruwMTAAAAAGv0tqeK9EpbjSJHWv2J6d9IdyWF";

    public function __construct()
    {
        parent::__construct(true);
        new LoginModel();
    }

    public function index()
    {
        try {
            DeiaAuthenticate::clearCookie();
            $this->template->display("login.tpl");
        } catch (SmartyException $e) {
            echo $e->getMessage();
        }
    }

    public function authentic()
    {
        try {
            $recaptcha = new \ReCaptcha\ReCaptcha($this->privatekey);
            # was there a reCAPTCHA response?
            if ($_POST["g-recaptcha-response"]) {
                $login = LoginModel::checkLogin($_POST["psa_email"], md5($_POST["psa_pwd"]));
                if ($login["total"] == 1) {
                    $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
                    if ($resp->isSuccess()) {

                        $crypter = new \src\Crypter();

                        try {
                            $this->template->caching = true;
                            if ($this->template->isCached("menu.tpl", $login["psa_cod"])) {
                                $this->template->clearCache("menu.tpl", $login["psa_cod"]);
                            }

                            $menu = new MenuController();
                            $menu->getMenuData($login["psa_cod"]);

                            setcookie("authentic", md5($_POST["psa_pwd"]), time() + 7200, "/IBANet", $_SERVER['SERVER_NAME']);
                            setcookie("psa_email", $_POST["psa_email"], time() + 7200, "/IBANet", $_SERVER['SERVER_NAME']);
                            setcookie("psa_pwd", md5($_POST["psa_pwd"]) . ":" . md5(date("Y<>m-%d")), time() + 7200, "/IBANet", $_SERVER['SERVER_NAME']);
                            setcookie("psa_cod", $crypter->encrypt($login["psa_cod"]), time() + 7200, "/IBANet", $_SERVER['SERVER_NAME']);
                            setcookie("time_session", date("Y-m-d H:i:s", time() + 7200), time() + 7200, "/IBANet", $_SERVER['SERVER_NAME']);

                            $json = json_encode(array(1));
                        } catch (SmartyException $sm) {
                            $json = json_encode(array($sm->getMessage()));
                        }
                    } else {
                        # set the error code so that we can display it
                        //echo json_encode(array($resp->getErrorCodes()));
                        $json = json_encode(array("Confira o Captcha informado"));
                    }
                } else {
                    $json = json_encode(array("Email e/ou senha não confere!"));
                }
            } else {
                $json = json_encode(array("Prove que você não é um robo!"));
            }

            unset($_POST["psa_pwd"]);
            $log = json_encode(array("Login", "authentic", $json, $login, $_POST, $_SERVER["HTTP_USER_AGENT"]));
            DeiaModel::setLogSistema($login["psa_cod"], $this->ip(), $log);

            echo $json;
        } catch (InvalidArgumentException $e) {
            echo json_encode(array($e->getMessage()));
        }
    }

    public function sessao()
    {
        DeiaAuthenticate::check(true);

        $time = LoginModel::getTimeDiff($_COOKIE["time_session"]);
        $data = array($time["time"], $time["segundos"]);

        echo json_encode($data);
    }

    public function renovaSessao()
    {
        //DeiaAuthenticate::check(true);

        setcookie("time_session", date("H:i:s", time() + 7200), time() + 7200, "/IBANet", $_SERVER['SERVER_NAME']);
        $time = LoginModel::getTimeDiff(date("H:i:s", time() + 7200));
        $data = array($time["time"], $time["segundos"]);

        echo json_encode($data);
    }

    public function validationUser($parametro)
    {
        DeiaAuthenticate::clearCookie();

        $crypter = new \src\Crypter();
        $psa_cod = $crypter->decrypt($parametro[2]);

        new PessoaModel();
        $pessoa = PessoaModel::selectDataEdit($psa_cod);

        if (!empty($pessoa["psa_pwd"])) {
            $content = "
                Aviso IBANet!<br><br>
                Não foi possível localizar solicitação para troca de senha.
                Caso você tenha usado um link para acessar esta página, este já
                pode ter sido usado numa atualização anterior. Se você deseja atualizar
                senha, entre na página de autenticação do IBANet e clique no link: Esqueceu sua Senha?<br>
                ou solicite ao administrador do sistema.
            ";

            $this->template->assign("hostImage", $this->urlAppImages);
            $this->template->assign("content", $content);
            $this->template->display("email.tpl");
        }else{
            $this->template->assign("psa_cod", $parametro[2]);
            $this->template->assign("nome", $pessoa["psa_nome"]);
            $this->template->display("password.tpl");
        }
    }

    public function setPasswordUser()
    {
        $recaptcha = new \ReCaptcha\ReCaptcha($this->privatekey);
        $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
        if ($resp->isSuccess()) {
            $crypter = new \src\Crypter();

            try {
                if (!empty($_POST["psa_pwd"]) && !empty($_POST["psa_cod"])) {
                    $psa_cod = $crypter->decrypt($_POST["psa_cod"]);

                    new PessoaModel();
                    if (PessoaModel::updatePasswordPessoa(md5($_POST["psa_pwd"]), $psa_cod)) {
                        $this->splash("Senha atualizada com sucesso! Clique em Ok para acessar o IBANet.");
                        $this->go($this->urlApp . "Login");
                    } else {
                        throw new PDOException("Não foi possível atualizar senha");
                    }
                } else {
                    throw new InvalidArgumentException("Não foi possível validar a senha informada");
                }
            } catch (PDOException $ex) {
                $this->splash($ex->getMessage());
                $this->go($this->urlApp . "Login");
            }
        }else{
            $this->splash("Prove que você não é um robo!");
            $this->go($this->urlApp . "Login/ValidationUser/".$_POST["psa_cod"]);
        }
    }

    public function teste()
    {

        $login = LoginModel::checkLogin("rafaeldemeirateixeira@gmail.com", md5("123456"));

        if ($login["total"] == 1) {
            var_export($login);
        } else {
            echo "False";
        }
    }

    public function forgot(){
        $this->template->display("forgot.tpl");
    }

    public function validationForgot(){
        $recaptcha = new \ReCaptcha\ReCaptcha($this->privatekey);
        $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
        if ($resp->isSuccess()) {
            $pessoa = LoginModel::selectDataEmail($_POST["psa_email"]);
            if($pessoa["psa_email"] == $_POST["psa_email"]){


                $destination[] = array("email"=>$pessoa["psa_email"],"nome"=>$pessoa["psa_nome"]);
                $mail = new DeiaMail($destination);

                $crypter = new \src\Crypter();
                $psa_cod = $crypter->encrypt($pessoa["psa_cod"]);
                $link = $this->urlApp."Login/ValidationUser/" . $psa_cod;
                $content = "
                    Olá eu sou o IBANet!<br><br>
                    Você recebeu este email porque foi selecionado para acessar o IBANet.<br>
                    Vou te ajudar neste processo de validação da sua conta. É muito simples, basta clicar neste
                    link <a href='$link'>PARA ATUALIZAR SUA SENHA NO SISTEMA</a>.
                    <br><br>
                    Este email é gerado dentro do sistema IBANet, por favor não responda e/ou encaminhar para terceiros.
                    Dúvidas devem ser encaminhadas para o Administrador do sistema.
                ";

                $this->template->assign("hostImage", $this->urlAppImages);
                $this->template->assign("content", utf8_decode($content));
                $html = $this->template->fetch("email.tpl");

                if($mail->sendSMTP(utf8_decode("Esqueci minha senha"), $html)){

                    new PessoaModel();
                    PessoaModel::updatePasswordPessoa(NULL, $pessoa["psa_cod"]);

                    $this->splash("Você receberá um email com as instruções para atualizar sua senha");
                    $this->go($this->urlApp . "Login");
                }else{
                    $this->splash("Não foi possível enviar o email. Tente novamente");
                    $this->go($this->urlApp . "Login/Forgot");
                }
            }else{
                $this->splash("O email informado não foi encontrado no IBANet ou o administrador não liberou o acesso!");
                $this->go($this->urlApp . "Login/Forgot");
            }
        }else{
            $this->splash("Prove que você não é um robo!");
            $this->go($this->urlApp . "Login/Forgot");
        }
    }
}
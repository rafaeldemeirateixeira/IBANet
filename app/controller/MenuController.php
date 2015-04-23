<?php

/**
 * Class controller
 */

class MenuController extends DeiaController{

    /**
     * Url do controlador
     * @var type
     */
    protected $urlController = null;

    private $encrypt = NULL;

    public function __construct(){
        parent::__construct(true);

        $this->urlController = $this->urlApp."Menu/";
        $this->template->assign("caption","Cadastro de Acesso ao sistema");
        $this->template->assign("subcaption","Define as permissões de acesso de cada usuário dentro do IBANet.");

        //Habilita os botoes para adicionar e listar dados
        $action["list"] = array("enable"=>true,"href"=>$this->urlController."Grid/");
        $this->template->assign("action", $action);

        $this->encrypt = new \src\Crypter();

        new MenuModel();
    }

    public function index(){
        $this->grid();
    }

    public function getMenuData($psa_cod){
        try{
            $data = MenuModel::selectData($psa_cod);

            foreach ($data as $value) {
                $menu[$value["menu_cod"]] = $value;
            }

            //ksort($menu);
            for($i=0; $i<3; $i++) {
                foreach ($menu as $key => $sub) {
                    $menu[$sub["menu_cod_pai"]]["sub"][$sub["menu_cod"]] = $sub;
                }
            }

            foreach ($menu as $key => $value) {
                if(!is_null($value["menu_cod_pai"]) || empty($key)){
                    unset($menu[$key]);
                }
            }

            $tree = $this->readArrayMenu($menu);

            $this->template->assign("content", $tree);
            $this->template->caching = true;
            $this->template->cache_lifetime = 7200;

            $this->template->fetch("menu.tpl", $psa_cod);

            return true;

        }  catch (PDOException $e){
            $this->splash($e->getMessage());

            return false;
        }

    }

    private function readArrayMenu($array, $nivel = 0){

        $nivel++;
        foreach ($array as $key => $value) {

            if(isset($value["sub"])){

                $menu .= "<li>";
                if($value["menu_controller"] == "#"){
                    $menu .= "<a href='#'>".$value["menu_nome"]."</a>";
                }else{
                    $menu .= "<a href='".$this->urlApp.$value["menu_controller"]."'>".$value["menu_nome"]."</a>";
                }
                $html = $this->readArrayMenu($value["sub"], $nivel);
                $menu .= "<ul>";
                $menu .= $html;
                $menu .= "</ul>";
                $menu .= "</li>";

            }else{
                $menu .= "<li>";
                if($value["menu_controller"] == "#"){
                    $menu .= "<a href='#'>".$value["menu_nome"]."</a>";
                }else{
                    $menu .= "<a href='".$this->urlApp.$value["menu_controller"]."'>".$value["menu_nome"]."</a>";
                }
                $menu .= "</li>";
            }
        }
        return $menu;
    }


    public function treeMenuDataSelect($psa_cod){
        try{
            $data = MenuModel::selectDataTree($psa_cod);

            foreach ($data as $value) {
                $menu[$value["value"]] = $value;
            }

            //ksort($menu);
            for($i=0; $i<3; $i++) {
                foreach ($menu as $key => $sub) {
                    $menu[$sub["menu_cod_pai"]]["sub"][$sub["value"]] = $sub;
                }
            }

            foreach ($menu as $key => $value) {
                if(!is_null($value["menu_cod_pai"]) || empty($key)){
                    unset($menu[$key]);
                }
            }

            $select = "<select multiple='multiple' name='menu_cod'>";
            $select .= $this->readTreeMenuSelect($menu);
            $select .= "</select>";

            return $select;

        }  catch (PDOException $e){
            $this->splash($e->getMessage());

            return false;
        }

    }

    private function readTreeMenuSelect($array, $space = ""){

        $space .= "-";

        foreach ($array as $value) {

            if(isset($value["sub"])){
                $option .= "<option value='".$value["value"]."'>".$value["menu_topico"]." ".$space."> ".$value["label"]."</option>";
                $option .= $this->readTreeMenuSelect($value["sub"], $space);
            }else{
                $option .= "<option value='".$value["value"]."'>".$value["menu_topico"]." ".$space."> ".$value["label"]."</option>";
            }
        }

        return $option;
    }

    public function grid(){
        DeiaAuthenticate::check(true);

        try{
            $grid = new DeiaGrid("psa_cod", $this->urlController, 10);

            if(empty($grid->postGrid["exibir"])){
                $grid->numRegisterTotal = MenuModel::selectDataTotalRegister();
                $grid->postGrid["exibir"] = $grid->numRegisterTotal;
            }else{
                $grid->numRegisterTotal = $grid->postGrid["exibir"];
            }

            $grid->dataGrid = MenuModel::selectDataGrid($grid->start, $grid->limit);
            $grid->urlPagination = $this->urlController."Grid/";

            $gridMenu[] = array("href"=>$this->urlController."Edit/","label"=>"Definir Acesso","icon"=>"fa-edit");
            $gridMenu[] = array("href"=>$this->urlController."View/","label"=>"Visualizar","icon"=>"fa-archive");
            $grid->gridMenu = $gridMenu;

            $grid->setColumnGrid(array("label"=>"#","field"=>"link","align"=>"center"));
            $grid->setColumnGrid(array("label"=>"Nome","field"=>"psa_nome","class"=>"","title"=>""));

            $this->show($grid->gridFetch());

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    public function edit($parametro){
        DeiaAuthenticate::check(true);

        $pessoa = MenuModel::selectDataEdit($parametro[2]);
        $this->template->assign("caption","Atenção!");
        $this->template->assign("subcaption","As alterações aqui definem o nível de acesso ao Sistema. Sabendo que está ação é função exclusiva do Administrador IBANet, é proibida qualquer alteração ou visualização destes dados por aqueles que não atendem as condição necessárias.<br>");

        $ibanet = array(
            array("value"=>0,"label"=>"Não"),
            array("value"=>1,"label"=>"Sim")
        );
        $field[] = array("type"=>"label","label"=>"Nome","text"=>$pessoa["psa_nome"]);
        //$field[] = array("type"=>"label","text"=>$this->treeMenuDataSelect($pessoa["psa_cod"]));
        $field[] = array("type"=>"select","name"=>"psa_ibanet","label"=>"Acessar IBANet","option"=>$ibanet,"selected"=>$pessoa["psa_ibanet"],"required"=>true,"mensagem"=>"Selecione o item Acessar IBANet");
        $field[] = array("type"=>"multi","name"=>"menu_cod","label"=>"Menu","option"=>MenuModel::selectComboBoxMenu($parametro[2]));
        $field[] = array("type"=>"checkbox","name"=>"definir_senha","value"=>1,"label"=>"Definir Senha?");
        $field[] = array("type"=>"hidden","name"=>"psa_cod","value"=>$pessoa["psa_cod"]);
        $field[] = array("type"=>"hidden","name"=>"psa_email","value"=>$pessoa["psa_email"]);

        $this->template->assign("fields",$field);
        $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "salvarEdit/","button"=>"Salvar"));
        $form = $this->template->fetch("form.tpl");
        $this->show($form);
    }

    public function salvarEdit(){

        DeiaAuthenticate::check(true);

        $psa_cod = $_POST["psa_cod"];

        try{
            $this->checkNumeric($_POST["psa_ibanet"]);

            MenuModel::$model->beginTransaction();

            MenuModel::updateIBANetPessoa($_POST["psa_ibanet"], $psa_cod);
            MenuModel::deleteMenu($psa_cod);

            if(is_array($_POST["menu_cod"])){
                foreach ($_POST["menu_cod"] as $value) {
                    $this->checkNumeric($value);
                    MenuModel::insertMenu($value, $psa_cod);
                }
            }

            MenuModel::$model->commit();

            if($_POST["definir_senha"]){

                new PessoaModel();
                PessoaModel::updatePasswordPessoa(NULL, $psa_cod);

                $pessoa = MenuModel::selectDataEdit($psa_cod);
                $destination[] = array("email"=>$pessoa["psa_email"],"nome"=>$pessoa["psa_nome"]);
                $mail = new DeiaMail($destination);

                $crypter = new \src\Crypter();
                $psa_cod = $crypter->encrypt($psa_cod);
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

                $mail->sendSMTP(utf8_decode("Confirmação e Validação"), $html);
            }

            $this->splash("Permissões salvas com Sucesso!");
            $this->go($this->urlController);
        } catch (PDOException $ex) {
            $this->splash($ex->getMessage());
            $this->go($this->urlController."Edit/".$psa_cod);
            MenuModel::$model->rollBack();
        }
    }

    public function email(){
        $crypter = new \src\Crypter();
        $psa_cod = $crypter->encrypt(49);
        $link = $this->urlApp."Login/ValidationUser/" . $psa_cod;
        $content = "
            Seja bem-vindo ao IBANet!<br><br>
            Você recebeu este email porque foi selecionado para acessar o IBANet.<br>
            Vou te ajudar neste processo de validação da sua conta. É muito simples, basta clicar neste
            link <a href='$link'>PARA CRIAR SUA SENHA NO IBANet</a>.
            <br><br>
            Este email é gerado dentro do sistema IBANet, favor não responder e/ou encaminhar para terceiros.
            Dúvidas devem ser encaminhadas para o Administrador do sistema.
        ";

        $this->template->assign("hostImage", $this->urlAppImages);
        $this->template->assign("content",$content);
        $this->template->display("email.tpl");
    }
}
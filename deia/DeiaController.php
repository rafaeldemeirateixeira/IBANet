<?php

/**
 *
 */

class DeiaController{

    /**
     * Instancia do modelo a ser manipulado pelo controlador
     * @var <boolean>
     */
    public $model = false;

    /**
     *  Prefixo do classe do controller
     * @var <string>
     */
    protected $nameClassController = null;

    /**
     *  Prefixo da classe model
     * @var <string>
     */
    protected $nameClassModel = "IndexModel";

    /**
     * Nome completo da classe modelo
     * @var <string>
     */
    protected $modelClassName = false;

    /**
     * Nome completo da classe controladora
     * @var <string>
     */
    protected $controllerClassName = false;

    /**
     *
     * @var <type>
     */
    private $params = null;

    /**
     * Url host da aplicação
     * @var <string>
     */
    protected $urlApp = null;

    /**
     * Url do diretorio de imagens
     * @var <string>
     */
    protected $urlAppImages = null;

    /**
     * Recebe a instancia da classe de template
     * @var type
     */
    protected $template = null;

    /**
     * Controlador da classe. É requirido o prefixo do nome da classe
     * @param <string> $name
     * @param <boolean> $model - Determina se o modelo será instanciado
     */
    public function __construct($smarty = false)
    {

        $this->urlApp = HOST . "/IBANet";
        if (PORT != 80) {
            $this->urlApp .= ':' . PORT;
        }
        $this->urlApp .= '/';
        $this->urlAppImages = $this->urlApp."public/image/";
        $this->params = explode("/", $_GET['params']);

        if($smarty){
            $this->template = new Smarty();

            $this->template->debugging       = false;
            $this->template->left_delimiter  = "{";
            $this->template->right_delimiter = "}";
            $this->template->template_dir    = ROOT . "/app/view/template/";
            $this->template->compile_dir     = ROOT . "/app/view/compiler/";
            $this->template->config_dir      = ROOT . "/app/view/config/";
            $this->template->cache_dir       = ROOT . "/app/view/cache/";
            $this->template->assign("host", $this->urlApp);
            $this->template->assign("hostImage", $this->urlApp . "public/image/");
        }
    }

    /**
     * Função de callback. Isso é mágica pura!
     * @param <object> $class Objeto da classe que contém o método
     * @param <string> $function - Nome do método
     * @param <array> $params - Parametros
     * @return <undefined>
     */
    public function callBack($classInstancia) {
        $method = @$this->params[1];

        if (!method_exists($classInstancia, $method)) {
            $method = "index";
            if(!method_exists($classInstancia, $method)){
                throw new Exception("O metodo não foi encontrado ou não foi declarado corretamente! A classe não contém o metodo Index.");

                return false;
            }
        }

        return $classInstancia->$method($this->params);
    }

    /**
     * Renderiza o retorno do controlador requisitado
     * @param <type> $name
     * @param <type> $params
     */
    public function renderPage($classInstancia) {
        try{
            return $this->callBack($classInstancia);
        }  catch (Exception $e){
            $this->splash($e->getMessage());
            $this->go($this->urlApp."NotFound");

            return false;
        }
    }

    /**
     *
     * @param <type> $string
     */
    protected function splash($string) {
        echo "<script>window.alert('{$string}')</script>";
    }

    /**
     *
     * @param <type> $string
     */
    protected function back() {
        echo "<script>history.back(-1);</script>";
    }

    /**
     * Redireciona para o controlador informado no parametro da função
     * @param <string> $url
     */
    protected function go($controller = "Index") {
        echo "<script>window.location='{$controller}'</script>";
    }

    /**
     * Remove acentos e cidilha
     * @param <type> $string
     * @return <type>
     */
    protected function removeAcentos($string) {
        $array1 = array(
            "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "nº",
            "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç", "Nº",
        );

        $array2 = array(
            "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "n.",
            "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C", "N.",
        );

        return str_replace($array1, $array2, $string);
    }

    /**
     * Limpa a url para paginacao
     * @param <type> $string
     * @return <type>
     */
    protected function limpaUrlPagination($string) {

        $array1 = array_merge(range("a", "z"), range("A", "Z"));
        $array1[] = "/";

        for($i = 0; $i<=52; $i++){
            $array2[] = "";
        }

        return str_replace($array1, $array2, $string);
    }

    public static function checkString($string){
        if(!is_string($string)){
            throw new InvalidArgumentException("Argumento [$string] inválido ou não informado");
        }
    }

    public static function checkObject($objeto){
        if(!is_object($objeto) || (is_object($objeto) && empty($objeto))){
            throw new InvalidArgumentException("Argumento [object] inválido ou não informado");
        }
    }

    public static function checkArray($array){
        if(!is_array($array) || (is_array($array) && $array == NULL)){
            throw new InvalidArgumentException("Array inválido, não informado ou vazio");
        }
    }

    public static function checkNumeric($numeric){
        if(!is_numeric($numeric)){
            throw new InvalidArgumentException("Argumento [$numeric] inválido, não informado ou vazio");
        }
    }

    public static function getSO(){
        $system = array(
            "Android",
            "Macintosh",
            "Windows",
            "IOS",
            "iPad",
            "iPhone"
        );
        foreach ($system as $value) {
            $pos = strpos($_SERVER["HTTP_USER_AGENT"], $value);
            if($pos !== false){
                return $value;
            }
        }

        return false;
    }

    /**
     * Seta com o parametro selected o indice que contenha o value
     * igual ao valor requerido
     * @param type $array
     * @param type $selected
     * @return array
     */
    protected function setSelectedComboBox($array, $selected){
        foreach ($array as $value) {
            if($value["value"] == $selected){
                $value["selected"] = 1;
            }

            $comboBox[] = $value;
        }

        return $comboBox;
    }

    /**
     * Converte a data de acordo com o formato indicado. Por padrão converte
     * datas do formato padrão mysql para o formato do Brasil
     * @param type $date
     * @param type $format
     * @return type DATE
     */
    protected function convertDate($date, $format = "br"){

        switch ($format) {
            case "br":
                $str = date("d/m/Y", strtotime($date));
                break;

            case "mysql":
                $str = implode("-",array_reverse(explode("/",$date)));
                break;
            default:
                break;
        }

        return $str;
    }

    protected function getEstadoCivil($str){
        switch ($str) {
            case "S":
                $ec = "Solteiro(a)";
                break;
            case "C":
                $ec = "Casado(a)";
                break;
            case "UE":
                $ec = "União Estável";
                break;
        }

        return $ec;
    }

    protected function getSexo($str){
        switch ($str) {
            case "M":
                $sexo = "Masculino";
                break;
            case "F":
                $sexo = "Feminino";
                break;
        }

        return $sexo;
    }

    protected function ip(){
        return $_SERVER["REMOTE_ADDR"];
    }

    public function show($html, $menu = "menu.tpl", $tpl = "home.tpl"){

        $crypter = new \src\Crypter();

        $this->template->caching = true;
        //$menu = $this->template->fetch($menu);
        $menu = $this->template->fetch($menu, $crypter->decrypt($_COOKIE["psa_cod"]));

        $this->template->caching = false;
        $this->template->assign("menu", $menu);
        $this->template->assign("content", $html);
        $this->template->display($tpl);
    }
}
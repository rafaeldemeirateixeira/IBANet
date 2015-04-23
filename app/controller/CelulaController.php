<?php

/**
 * Class controller
 */

class CelulaController extends DeiaController{

    /**
     * Url do controlador
     * @var type
     */
    protected $urlController = null;

    public function __construct(){
        DeiaAuthenticate::check(true);
        parent::__construct(true);
        $this->urlController = $this->urlApp . "Celula/";
        $this->template->assign("caption","Cadastro de Celulas");
        $this->template->assign("subcaption","Destina-se ao cadastro de celulas itegradas a IBA");

        //Habilita os botoes para adicionar e listar dados
        $action["add"] = array("enable"=>true,"href"=>$this->urlController."Add/");
        $action["list"] = array("enable"=>true,"href"=>$this->urlController."Grid/");
        $this->template->assign("action", $action);

        new CelulaModel();
    }


    public function index(){

        try {
            $this->grid();
        } catch (SmartyException $e) {
            echo $e->getMessage();
        }
    }

    public function add(){
        try{
            $select = CelulaModel::selectComboBox(0);
            $field[] =array("type"=>"select","name"=>"cel_cod_pai","label"=>"Célula Pai","required"=>0,"option"=>$select);
            $field[] =array("type"=>"text","name"=>"cel_nome","label"=>"Nome","required"=>true,"mensagem"=>"Favor informar o nome da célula!");
            $dia = array(
                array("value"=>"Terça","label"=>"Terça"),
                array("value"=>"Sábado","label"=>"Sábado")
            );
            $field[] =array("type"=>"select","name"=>"cel_dia","label"=>"Dia da semana","required"=>true,"mensagem"=>"Selecione o dia da semana","option"=>$dia);
            $field[] =array("type"=>"date","name"=>"cel_data_nascimento","label"=>"Data Nascimento","required"=>0);
            $field[] =array("type"=>"textarea","name"=>"cel_observacao","label"=>"Observação","required"=>0);

            $this->template->assign("fields",$field);
            $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "Salvar","button"=>"Salvar"));
            $form = $this->template->fetch("form.tpl");

            $this->show($form);

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    /**
     *
     */
    public function salvar(){
        try{
            $this->checkString($_POST["cel_nome"]);
            $this->checkString($_POST["cel_dia"]);
            $this->checkString($_POST["cel_data_nascimento"]);
            //$this->checkNumeric($_POST["mnt_cod_pai"]);

            if(empty($_POST["cel_cod_pai"])){
                $_POST["cel_cod_pai"] = NULL;
            }

            $data = array($_POST["cel_cod_pai"],$_POST["cel_nome"],$_POST["cel_dia"],$_POST["cel_data_nascimento"],$_POST["cel_observacao"]);
            if(CelulaModel::insert($data)){
                $this->splash("Célula salvo com sucesso");
                $this->go($this->urlController);
            }else{
                $this->splash("Tentativa falhou! Tente novamente");
                $this->go($this->urlController);
            }
        }catch (InvalidArgumentException $e){
            $this->splash($e->getMessage());
            $this->go($this->urlController);
        }
    }

    /**
     *
     */
    public function salvarEdit(){
        try{
            $this->checkString($_POST["cel_nome"]);
            $this->checkString($_POST["cel_dia"]);
            $this->checkString($_POST["cel_data_nascimento"]);
            //$this->checkNumeric($_POST["mnt_cod_pai"]);

            if(empty($_POST["cel_cod_pai"])){
                $_POST["cel_cod_pai"] = NULL;
            }

            $data = array($_POST["cel_cod_pai"],$_POST["cel_nome"],$_POST["cel_dia"],$_POST["cel_data_nascimento"],$_POST["cel_observacao"], $_POST["cel_cod"]);
            if(CelulaModel::update($data)){
                $this->splash("Célula alterada com sucesso");
                $this->go($this->urlController);
            }else{
                $this->splash("Tentativa de alterar célula falhou! Tente novamente");
                $this->go($this->urlController);
            }
        }catch (InvalidArgumentException $e){
            $this->splash($e->getMessage());
            $this->go($this->urlController);
        }
    }

    /**
     *
     * @return type
     */
    public function grid(){
        try{
            $grid = new DeiaGrid("cel_cod", $this->urlController, 10);

            if(empty($grid->postGrid["exibir"])){
                $grid->numRegisterTotal = CelulaModel::selectDataTotalRegister();
                $grid->postGrid["exibir"] = $grid->numRegisterTotal;
            }else{
                $grid->numRegisterTotal = $grid->postGrid["exibir"];
            }

            $gridMenu[] = array("href"=>$this->urlController."Edit/","label"=>"Editar","icon"=>"fa-edit");
            $gridMenu[] = array("href"=>$this->urlController."View/","label"=>"Visualizar","icon"=>"fa-archive");
            $grid->gridMenu = $gridMenu;

            $grid->setColumnGrid(array("label"=>"#","field"=>"link","align"=>"center"));
            $grid->setColumnGrid(array("label"=>"Nome","field"=>"cel_nome","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Dia","field"=>"cel_dia","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Pessoas","field"=>"pessoas","class"=>"","title"=>""));

            $grid->dataGrid = CelulaModel::selectData($grid->start, $grid->limit);

            $this->show($grid->gridFetch());

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    public function view($parametro){

        $view = CelulaModel::selectDataView($parametro[2]);

        $nome = explode(",", $view["psa_nome"]);
        $nivel = explode(",", $view["nivel"]);
        $x = count($nivel);

        for($i = 0; $i<$x; $i++){
            if($nivel[$i] == 2){
                $view["supervisor"] .= $nome[$i];
            }elseif($nivel[$i] == 1){
                $view["lider"] .= $nome[$i];
            }
        }

        $this->template->assign("title",$view["cel_nome"] . " - " .$view["cel_cod"]);
        $this->template->assign("subTitle",$view["cel_observacao"]);
        $this->template->assign("dateTime",date("d/m/Y H:i:s"));

        $section[] = array(
            "title"=>"Dados da Célula",
            "item"=>array(
                array("label"=>"Nome","value"=>$view["cel_nome"]),
                array("label"=>"Lider","value"=>$view["lider"]),
                array("label"=>"Supervisor","value"=>$view["supervisor"]),
                array("label"=>"Célula Pai","value"=>$view["cel_pai"]),
                array("label"=>"Data de Nascimento","value"=>$this->convertDate($view["cel_data_nascimento"])),
                array("label"=>"Dia","value"=>$view["cel_dia"]),
                array("label"=>"Observação","value"=>$view["cel_observacao"]),
            ),
        );

        $this->template->assign("section", $section);
        $view = $this->template->fetch("view.tpl");

        $this->template->assign("subcaption","Dados detalhados do registro.");
        $this->show($view);
    }

    public function edit($parametro){

        $cel_cod = $parametro[2];

        $celula = CelulaModel::selectDataView($cel_cod);
        $select = CelulaModel::selectComboBoxCelulaPai($cel_cod);

        $field[] = array("type"=>"hidden","name"=>"cel_cod","value"=>$celula["cel_cod"]);
        $field[] = array("type"=>"label","label"=>"Célula","text"=>$celula["cel_nome"]);
        $field[] = array("type"=>"select","name"=>"cel_cod_pai","label"=>"Célula Pai","required"=>0,"option"=>$select);
        $field[] = array("type"=>"text","name"=>"cel_nome","value"=>$celula["cel_nome"],"label"=>"Nome","required"=>true,"mensagem"=>"Favor informar o nome da célula!");
        $dia = array(
            array("value"=>"Terça","label"=>"Terça"),
            array("value"=>"Sábado","label"=>"Sábado")
        );
        $field[] = array("type"=>"select","name"=>"cel_dia","label"=>"Dia da semana","required"=>true,"mensagem"=>"Selecione o dia da semana","option"=>  $this->setSelectedComboBox($dia, $celula["cel_dia"]));
        $field[] = array("type"=>"date","name"=>"cel_data_nascimento","value"=>$this->convertDate($celula["cel_data_nascimento"]),"label"=>"Data Nascimento","required"=>0);
        $field[] = array("type"=>"textarea","name"=>"cel_observacao","value"=>$celula["cel_observacao"],"label"=>"Observação","required"=>0);

        $this->template->assign("fields",$field);
        $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "SalvarEdit","button"=>"Salvar"));
        $form = $this->template->fetch("form.tpl");
        $this->template->assign("caption","Alteração de Celulas");
        $this->template->assign("subcaption","Modifica os dados cadastrados da célula");

        $this->show($form);

    }

    public function ajaxCelulaLider(){
        new PessoaModel();
        $post = $_POST["data"];
        try{
            $result = PessoaModel::selectPessoaAjax($post);
            if(!empty($result)){
                echo json_encode($result);
            }else{
                echo json_encode(array(array("value"=>"NENHUM RESULTADO ENCONTRADO!")));
            }
        }catch (InvalidArgumentException $e){
            echo json_encode(array("value"=>$e->getMessage()));
        }
    }
}
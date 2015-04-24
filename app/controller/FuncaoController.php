<?php

/**
 * Class controller
 */

class FuncaoController extends DeiaController{

    /**
     * Url do controlador
     * @var type
     */
    protected $urlController = null;

    public function __construct(){
        DeiaAuthenticate::check(true);
        parent::__construct(true);
        $this->urlController = $this->urlApp . "Funcao/";
        $this->template->assign("caption","Cadastro de Funções");
        $this->template->assign("subcaption","Destina-se ao cadastro de funções exercidas dentro da IBA");

        //Habilita os botoes para adicionar e listar dados
        $action["add"] = array("enable"=>true,"href"=>$this->urlController."Add/");
        $action["list"] = array("enable"=>true,"href"=>$this->urlController."Grid/");
        $this->template->assign("action", $action);

        new FuncaoModel();
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
            $select = FuncaoModel::selectComboBox(0);
            $field[] =array("type"=>"select","name"=>"fnc_cod_pai","label"=>"Função Pai","required"=>true,"mensagem"=>"Selecione um cargo de nivel superior","option"=>$select);
            $field[] =array("type"=>"text","name"=>"fnc_nome","label"=>"Nome","required"=>true,"mensagem"=>"Favor informar o nome da função!");

            $this->template->assign("fields",$field);
            $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "Salvar","button"=>"Salvar"));
            $form = $this->template->fetch("form.tpl");

            $this->show($form);

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    public function edit($paramtro){
        try{
            $fnc_cod = $paramtro[2];
            $edit = FuncaoModel::selectDataEdit($fnc_cod);

            $select = FuncaoModel::selectComboBox($edit["fnc_cod"]);
            $field[] = array("type"=>"hidden","name"=>"fnc_cod","value"=>$edit["fnc_cod"]);
            $field[] = array("type"=>"select","name"=>"fnc_cod_pai","label"=>"Função Pai","required"=>true,"mensagem"=>"Selecione um cargo de nivel superior","option"=>$select);
            $field[] = array("type"=>"text","name"=>"fnc_nome","value"=>$edit["fnc_nome"],"label"=>"Nome","required"=>true,"mensagem"=>"Favor informar o nome da função!");

            $this->template->assign("fields",$field);
            $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "SalvarEdit","button"=>"Salvar"));
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
            $this->checkString($_POST["fnc_nome"]);

            if(empty($_POST["fnc_cod_pai"])){
                $_POST["fnc_cod_pai"] = NULL;
            }

            $data = array($_POST["fnc_cod_pai"], $_POST["fnc_nome"]);
            if(FuncaoModel::insert($data)){
                $this->splash("Função salva com sucesso");
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
            $this->checkString($_POST["fnc_nome"]);
            $this->checkNumeric($_POST["fnc_cod"]);

            if(empty($_POST["fnc_cod_pai"])){
                $_POST["fnc_cod_pai"] = NULL;
            }

            $data = array($_POST["fnc_cod_pai"], $_POST["fnc_nome"], $_POST["fnc_cod"]);
            if(FuncaoModel::update($data)){
                $this->splash("Tipo alterado com sucesso");
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
     * @return type
     */
    public function grid(){
        try{
            $grid = new DeiaGrid("fnc_cod","Index", 10);

            if(empty($grid->postGrid["exibir"])){
                $grid->numRegisterTotal = FuncaoModel::selectDataTotalRegister();
                $grid->postGrid["exibir"] = $grid->numRegisterTotal;
            }else{
                $grid->numRegisterTotal = $grid->postGrid["exibir"];
            }

            $gridMenu[] = array("href"=>$this->urlController."Edit/","label"=>"Editar","icon"=>"fa-edit");
            $grid->gridMenu = $gridMenu;

            $grid->setColumnGrid(array("label"=>"FNCCOD","field"=>"link","align"=>"left"));
            $grid->setColumnGrid(array("label"=>"Função","field"=>"fnc_nome_pai","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Função Pai","field"=>"fnc_nome","class"=>"","title"=>""));

            $grid->dataGrid = FuncaoModel::selectData($grid->start, $grid->limit);

            $this->show($grid->gridFetch());

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }
}
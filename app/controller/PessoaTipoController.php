<?php

/**
 * Class controller
 */

class PessoaTipoController extends DeiaController{

    /**
     * Url do controlador
     * @var type
     */
    protected $urlController = null;

    public function __construct(){
        DeiaAuthenticate::check(true);
        parent::__construct(true);
        $this->urlController = $this->urlApp . "PessoaTipo/";
        $this->template->assign("caption","Cadastro de Tipos");
        $this->template->assign("subcaption","Destina-se ao cadastro de tipos de pessoa. Ex: Membros, Agregados, etc...");

        //Habilita os botoes para adicionar e listar dados
        $action["add"] = array("enable"=>true,"href"=>$this->urlController."Add/");
        $action["list"] = array("enable"=>true,"href"=>$this->urlController."Grid/");
        $this->template->assign("action", $action);

        new PessoaTipoModel();
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
            $field[] = array("type"=>"text","name"=>"tipo_nome","label"=>"Tipo de Pessoa","required"=>true,"mensagem"=>"Favor informar o nome do tipo!");

            $this->template->assign("fields",$field);
            $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "Salvar","button"=>"Salvar"));
            $form = $this->template->fetch("form.tpl");

            $this->show($form);

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    public function edit($parametro){
        try{
            $edit = PessoaTipoModel::selectDataEdit($parametro[2]);

            $field[] = array("type"=>"hidden","name"=>"tipo_cod","value"=>$edit["tipo_cod"]);
            $field[] = array("type"=>"text","name"=>"tipo_nome","value"=>$edit["tipo_nome"],"label"=>"Tipo de Pessoa","required"=>true,"mensagem"=>"Favor informar o nome do tipo!");

            $this->template->assign("fields",$field);
            $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "SalvarEdit","button"=>"Salvar"));
            $form = $this->template->fetch("form.tpl");

            $this->show($form);

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    public function delete($parametro){
        try{
            $tipo_cod = $parametro[2];

            $this->checkNumeric($tipo_cod);

            if(PessoaTipoModel::delete($tipo_cod)){
                $this->splash("Registro removido com sucesso");
                $this->go($this->urlController);
            }else{
                $this->splash("Tentativa de remover falhou! Tente novamente");
                $this->go($this->urlController);
            }
        }catch (PDOException $e){
            $this->splash($e->getMessage());
            $this->go($this->urlController);
        }
    }

    /**
     *
     */
    public function salvar(){
        try{
            $this->checkString($_POST["tipo_nome"]);

            $data = array($_POST["tipo_nome"]);
            if(PessoaTipoModel::insert($data)){
                $this->splash("Tipo salvo com sucesso");
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
            $tipo_cod = $_POST["tipo_cod"];
            $tipo_nome = $_POST["tipo_nome"];

            $this->checkNumeric($tipo_cod);
            $this->checkString($tipo_nome);

            if(PessoaTipoModel::update($tipo_cod, $tipo_nome)){
                $this->splash("Tipo salvo com sucesso");
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
            $grid = new DeiaGrid("tipo_cod", $this->urlController, 10);

            if(empty($grid->postGrid["exibir"])){
                $grid->numRegisterTotal = PessoaTipoModel::selectDataTotalRegister();
                $grid->postGrid["exibir"] = $grid->numRegisterTotal;
            }else{
                $grid->numRegisterTotal = $grid->postGrid["exibir"];
            }
            $grid->setColumnGrid(array("label"=>"TIPCOD","field"=>"link","align"=>"left"));
            $grid->setColumnGrid(array("label"=>"Nome do Tipo","field"=>"tipo_nome","class"=>"","title"=>"Nome do Tipo"));

            $gridMenu[] = array("href"=>$this->urlController."Edit/","label"=>"Editar","icon"=>"fa-edit");
            $gridMenu[] = array("href"=>"#","label"=>"Remover","icon"=>"fa-archive","confirm"=>true,"location"=>$this->urlController."Delete");
            $grid->gridMenu = $gridMenu;
            $grid->dataGrid = PessoaTipoModel::selectData($grid->start, $grid->limit);

            $this->show($grid->gridFetch());

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }
}
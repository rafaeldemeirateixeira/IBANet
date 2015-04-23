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

        new PessoaTipoModel();
    }


    public function index(){

        try {
            $this->form();

        } catch (SmartyException $e) {
            echo $e->getMessage();
        }
    }

    public function form(){
        try{
            $field[] =array("type"=>"text","name"=>"tipo_nome","label"=>"Tipo de Pessoa","required"=>true,"mensagem"=>"Favor informar o nome do tipo!");

            $this->template->assign("fields",$field);
            $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "Salvar"));
            $form = $this->template->fetch("form.tpl");

            $this->template->assign("content",$form);
            $this->template->display("home.tpl");
        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
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
     * @return type
     */
    public function grid(){
        try{
            $grid = new DeiaGrid("email","Index");

            $grid->numRegisterTotal = 101;
            $grid->urlPagination = "$this->urlApp"."Index/";
            $grid->setColumnGrid(array("label"=>"#","field"=>"link","align"=>"center"));
            $grid->setColumnGrid(array("label"=>"Cod","field"=>"cod","class"=>"","title"=>"Coluna do Códido"));
            $grid->setColumnGrid(array("label"=>"Nome","field"=>"nome","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Idade","field"=>"idade","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Cargo","field"=>"cargo","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Estato Civil","field"=>"estadoCivil","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Célula","field"=>"celula","class"=>"","title"=>""));

            for($i = 1; $i <= 100; $i++){
                $grid->setDataGrid(
                    array(
                        DeiaHtml::a($this->urlApp."Index/Edit/".str_pad($i,4,"0",STR_PAD_LEFT), DeiaHtml::img($this->urlAppImages."edit_16x16.png")),
                        "cod"=>str_pad($i,4,"0",STR_PAD_LEFT),
                        "nome"=>"Rafael de Meira Teixeira",
                        "idade"=>"33",
                        "cargo"=>"Professor de EBD",
                        "estadoCivil"=>"Casado",
                        "celula"=>"Supervisor"
                    )
                );
            }

            return $grid->gridFetch();
        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }
}
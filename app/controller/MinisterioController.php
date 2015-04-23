<?php

/**
 * Class controller
 */

class MinisterioController extends DeiaController{

    /**
     * Url do controlador
     * @var type
     */
    protected $urlController = null;

    public function __construct(){
        DeiaAuthenticate::check(true);
        parent::__construct(true);
        $this->urlController = $this->urlApp . "Ministerio/";
        $this->template->assign("caption","Cadastro de Ministérios");
        $this->template->assign("subcaption","Destina-se ao cadastro de ministérios itegrados a IBA");

        new MinisterioModel();
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
            $select = MinisterioModel::selectComboBox(0);
            $field[] =array("type"=>"select","name"=>"mnt_cod_pai","label"=>"Ministério Pai","required"=>0,"option"=>$select);
            $field[] =array("type"=>"text","name"=>"mnt_nome","label"=>"Nome do Ministério","required"=>true,"mensagem"=>"Favor informar o nome do ministerio!");
            $field[] =array("type"=>"search","name"=>"psa_nome","label"=>"Nome do Lider","url"=>"{$this->urlApp}Pessoa/AjaxPessoa/","nameHidden"=>"psa_cod");
            $field[] =array("type"=>"date","name"=>"mnt_data_nascimento","label"=>"Data Nascimento","required"=>0);
            $field[] =array("type"=>"textarea","name"=>"mnt_observacao","label"=>"Observação","required"=>0);

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
            $this->checkString($_POST["mnt_nome"]);
            $this->checkString($_POST["mnt_data_nascimento"]);
            $this->checkString($_POST["mnt_observacao"]);
            //$this->checkNumeric($_POST["mnt_cod_pai"]);

            if(empty($_POST["mnt_cod_pai"])){
                $_POST["mnt_cod_pai"] = NULL;
            }

            if(empty($_POST["psa_cod"])){
                $_POST["psa_cod"] = NULL;
            }

            $data = array($_POST["mnt_cod_pai"], $_POST["psa_cod"],$_POST["mnt_nome"],$_POST["mnt_data_nascimento"],$_POST["mnt_observacao"]);
            if(MinisterioModel::insert($data)){
                $this->splash("Ministerio salvo com sucesso");
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
            $grid = new DeiaGrid("mnt_cod","Index", 10);

            if(empty($grid->postGrid["exibir"])){
                $grid->numRegisterTotal = CelulaModel::selectDataTotalRegister();
                $grid->postGrid["exibir"] = $grid->numRegisterTotal;
            }else{
                $grid->numRegisterTotal = $grid->postGrid["exibir"];
            }

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

            $this->show($grid->gridFetch());

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }
}
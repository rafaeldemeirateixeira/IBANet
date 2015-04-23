<?php

/**
 * Class controller
 */

class CelulaFuncaoController extends DeiaController{

    /**
     * Url do controlador
     * @var type
     */
    protected $urlController = null;

    public function __construct(){
        DeiaAuthenticate::check(true);
        parent::__construct(true);
        $this->urlController = $this->urlApp . "CelulaFuncao/";
        $this->template->assign("caption","Cadastro de Funções da Celula");
        $this->template->assign("subcaption","Define o cargo da pessoa na célula selecionada");

        //Habilita os botoes para adicionar e listar dados
        $action["add"] = array("enable"=>true,"href"=>$this->urlController."Add/");
        $action["list"] = array("enable"=>true,"href"=>$this->urlController."Grid/");
        $this->template->assign("action", $action);

        new CelulaFuncaoModel();
    }


    public function index(){

        try {
            $this->grid();
        } catch (SmartyException $e) {
            echo $e->getMessage();
        }
    }

    public function add(){
        $this->template->assign("subcaption","Está função insere um novo registro.<br>ATENÇÃO: O registro inserido aqui apaga todas as atribuições referentes a pessoa selecionada. Caso queira acrescentar uma nova atribuição, escolha a opção EDITAR no registro referente.");
        try{
            $field[] =array("type"=>"search","name"=>"psa_nome","label"=>"Nome","required"=>true,"url"=>"{$this->urlApp}Pessoa/AjaxPessoa/","nameHidden"=>"psa_cod");
            $funcao = array(
                array("value"=>"1","label"=>"Líder"),
                array("value"=>"2","label"=>"Supervisor"),
                array("value"=>"3","label"=>"Coordenador"),
            );
            $field[] =array("type"=>"select","name"=>"fnc_cod","label"=>"Função","required"=>true,"mensagem"=>"Selecione a função","option"=>$funcao);

            $celula = CelulaFuncaoModel::selectComboBox(0);
            $field[] =array("type"=>"multi","name"=>"cel_cod","label"=>"Célula","required"=>true,"mensagem"=>"Selecione a célula","option"=>$celula);

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
            $fnc_cod = $_POST["fnc_cod"];
            $cel_cod = $_POST["cel_cod"];
            $psa_cod = $_POST["psa_cod"];

            CelulaFuncaoModel::$model->beginTransaction();

            $this->checkNumeric($fnc_cod);
            $this->checkArray($cel_cod);
            $this->checkNumeric($psa_cod);

            if($fnc_cod == 1 && count($cel_cod) != 1){
                throw new InvalidArgumentException("Alerta: O líder só pode ser atribuida a uma célula.");
            }

            CelulaFuncaoModel::delCelulaPessoaPSA($psa_cod);

            /**
             * Remove a função da respectiva celula
             */
            foreach ($cel_cod as $value) {
                CelulaFuncaoModel::delCelulaPessoaCelNiv($value, $fnc_cod);
            }

            /**
             * Insere a nova funcao a respectiva pessoa
             */
            foreach ($cel_cod as $value) {
                CelulaFuncaoModel::setCelulaPessoa($psa_cod, $value, $fnc_cod);
            }

            CelulaFuncaoModel::$model->commit();

            $this->splash("Função atribuida com sucesso");
            $this->go($this->urlController."CelulaFuncao");

        }catch (InvalidArgumentException $e){
            CelulaFuncaoModel::$model->rollBack();
            $this->splash("Tentativa falhou! Tente novamente: ".$e->getMessage());
            $this->go($this->urlController."Add");
        }
    }

    /**
     *
     */
    public function salvarEdit(){
        try{
            $fnc_cod = $_POST["fnc_cod"];
            $cel_cod = $_POST["cel_cod"];
            $psa_cod = $_POST["psa_cod"];
            $psa_cod_novo = $_POST["psa_cod_novo"];

            CelulaFuncaoModel::$model->beginTransaction();

            $this->checkNumeric($fnc_cod);
            $this->checkArray($cel_cod);
            $this->checkNumeric($psa_cod);

            if($fnc_cod == 1 && count($cel_cod) != 1){
                throw new InvalidArgumentException("Alerta: O líder só pode ser atribuida a uma célula.");
            }

            CelulaFuncaoModel::delCelulaPessoaPSA($psa_cod);

            if(!empty($psa_cod_novo)){
                CelulaFuncaoModel::delCelulaPessoaPSA($psa_cod_novo);
                $psa_cod = $psa_cod_novo;
            }

            /**
             * Remove a função da respectiva celula
             */
            foreach ($cel_cod as $value) {
                CelulaFuncaoModel::delCelulaPessoaCelNiv($value, $fnc_cod);
            }

            /**
             * Insere a nova funcao a respectiva pessoa
             */
            foreach ($cel_cod as $value) {
                CelulaFuncaoModel::setCelulaPessoa($psa_cod, $value, $fnc_cod);
            }

            CelulaFuncaoModel::$model->commit();

            $this->splash("Função atribuida com sucesso");
            $this->go($this->urlController."CelulaFuncao");

        }catch (InvalidArgumentException $e){
            CelulaFuncaoModel::$model->rollBack();
            $this->splash("Tentativa falhou! Tente novamente: ".$e->getMessage());
            $this->go($this->urlController."Add");
        }
    }

    /**
     *
     * @return type
     */
    public function grid(){
        $this->template->assign("subcaption","Lista a pessoa e sua respectiva função dentro da célula");
        try{
            $grid = new DeiaGrid("cel_psa_cod", $this->urlController, 10);

            if(empty($grid->postGrid["exibir"])){
                $grid->numRegisterTotal = CelulaFuncaoModel::selectDataTotalRegister();
                $grid->postGrid["exibir"] = $grid->numRegisterTotal;
            }else{
                $grid->numRegisterTotal = $grid->postGrid["exibir"];
            }

            $gridMenu[] = array("href"=>$this->urlController."Edit/","label"=>"Editar","icon"=>"fa-edit");
            $gridMenu[] = array("href"=>"#","label"=>"Delete","confirm"=>true,"location"=>$this->urlController."Delete","icon"=>"fa-edit");
            $grid->gridMenu = $gridMenu;

            $grid->setColumnGrid(array("label"=>"CELPSA","field"=>"link","align"=>"left"));
            $grid->setColumnGrid(array("label"=>"Célula","field"=>"cel_nome","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Função","field"=>"fnc_nome","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Nome","field"=>"psa_nome","class"=>"","title"=>""));

            $grid->dataGrid = CelulaFuncaoModel::selectData($grid->start, $grid->limit);

            $this->show($grid->gridFetch());

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    public function edit($parametro){

        $codigo = explode("CP", $parametro[2]);
        $edit = CelulaFuncaoModel::selectDataEdit($codigo[1]);

        $this->template->assign("subcaption","Está função eidta os registros salvos.<br>ATENÇÃO: Na função lider deve-se escolher apenas uma célula.");
        try{
            $field[] = array("type"=>"label","label"=>"Nome Atual","text"=>$edit["psa_nome"]);
            $field[] = array("type"=>"search","name"=>"psa_nome","label"=>"Novo Nome","required"=>true,"url"=>"{$this->urlApp}Pessoa/AjaxPessoa/","nameHidden"=>"psa_cod_novo");
            $field[] = array("type"=>"hidden","name"=>"psa_cod","value"=>$codigo[1]);

            $funcao = array(
                array("value"=>"1","label"=>"Líder"),
                array("value"=>"2","label"=>"Supervisor"),
                array("value"=>"3","label"=>"Coordenador"),
            );
            $funcao = $this->setSelectedComboBox($funcao, $edit["funcao"]);
            $field[] =array("type"=>"select","name"=>"fnc_cod","label"=>"Função","required"=>true,"mensagem"=>"Selecione a função","option"=>$funcao);

            $celula = CelulaFuncaoModel::selectComboBox($codigo[1]);
            $field[] =array("type"=>"multi","name"=>"cel_cod","label"=>"Célula","required"=>true,"mensagem"=>"Selecione a célula","option"=>$celula);

            $this->template->assign("fields",$field);
            $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "SalvarEdit","button"=>"Salvar"));
            $form = $this->template->fetch("form.tpl");

            $this->show($form);
        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }

    }

    public function delete($parametro){
        $codigo = explode("CP", $parametro[2]);

        if(CelulaFuncaoModel::delCelulaFuncaoPsaCel($codigo[0], $codigo[1])){
            $this->splash("Registro {$parametro[2]} removido com sucesso!");
            $this->go($this->urlController);
        }else{
            $this->splash("Falha ao remover registro {$parametro[2]}. Tente novamente!");
        }
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
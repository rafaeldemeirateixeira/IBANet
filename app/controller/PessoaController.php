<?php

/**
 * Class controller
 */

class PessoaController extends DeiaController{

    /**
     * Url do controlador
     * @var type
     */
    protected $urlController = null;

    public function __construct(){
        DeiaAuthenticate::check(true);
        parent::__construct(true);
        $this->urlController = $this->urlApp . "Pessoa/";
        $this->template->assign("caption","Cadastro de Pessoas");
        $this->template->assign("subcaption","Destina-se ao cadastro de pessoa filiadas a IBA.");

        //Habilita os botoes para adicionar e listar dados
        $action["add"] = array("enable"=>true,"href"=>$this->urlController."Add/");
        $action["list"] = array("enable"=>true,"href"=>$this->urlController."Grid/");
        $this->template->assign("action", $action);

        new PessoaModel();
    }


    public function index(){

        try {
            $this->grid();

        } catch (SmartyException $e) {
            echo $e->getMessage();
        }
    }

    /**
     *
     */
    public function add(){
        $this->template->assign("caption","Cadastro de Pessoas");
        $this->template->assign("subcaption","Selecione a célula, funções e ministérios relacionados a pessoa a ser cadastrada.");

        new PessoaTipoModel();
        new CelulaModel();
        new FuncaoModel();
        new MinisterioModel();

        $field[] =array("type"=>"progressbar","name"=>"progress","value"=>50,"label"=>"Progresso");

        $tipo = PessoaTipoModel::selectAll(0);
        $field[] =array("type"=>"select","name"=>"tipo_cod","label"=>"Tipo","option"=>$tipo,"required"=>true,"mensagem"=>"Favor informar o tipo da pessoa!");

        $celula = CelulaModel::selectComboBox(0);
        $field[] = array("type"=>"select","name"=>"cel_cod","label"=>"Célula","option"=>$celula,"required"=>true);

        $funcao = FuncaoModel::selectComboBox(0);
        $field[] = array("type"=>"multi","name"=>"fnc_cod","label"=>"Funções","option"=>$funcao);

        $ministerio = MinisterioModel::selectComboBox(0);
        $field[] = array("type"=>"multi","name"=>"mnt_cod","label"=>"Ministérios","option"=>$ministerio);

        $this->template->assign("fields",$field);
        $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "setDadosEspecificos","button"=>"Próximo"));
        $form = $this->template->fetch("form.tpl");

        $this->show($form);
    }

    /**
     *
     */
    public function editDadosEspecificos($parametro){
        $this->template->assign("caption","Edição do cadastro de Pessoas");
        $this->template->assign("subcaption","Selecione a célula, funções e ministérios relacionados a pessoa a ser alterada.");

        new PessoaTipoModel();
        new CelulaModel();
        new FuncaoModel();
        new MinisterioModel();
        $edit = PessoaModel::selectDataEdit($parametro[2]);

        $field[] = array("type"=>"progressbar","name"=>"progress","value"=>50,"label"=>"Progresso");
        $field[] = array("type"=>"hidden","name"=>"psa_cod","value"=>$parametro[2]);
        $field[] = array("type"=>"label","label"=>"Nome","text"=>$edit["psa_nome"]);
        $tipo = PessoaTipoModel::selectAll($parametro[2]);
        $field[] =array("type"=>"select","name"=>"tipo_cod","label"=>"Tipo","option"=>$tipo,"required"=>true,"mensagem"=>"Favor informar o tipo da pessoa!");

        $celula = CelulaModel::selectComboBox($parametro[2]);
        $field[] = array("type"=>"select","name"=>"cel_cod","label"=>"Célula","option"=>$celula,"required"=>true);

        $funcao = FuncaoModel::selectComboBox($parametro[2]);
        $field[] = array("type"=>"multi","name"=>"fnc_cod","label"=>"Funções","option"=>$funcao);

        $ministerio = MinisterioModel::selectComboBox($parametro[2]);
        $field[] = array("type"=>"multi","name"=>"mnt_cod","label"=>"Ministérios","option"=>$ministerio);

        $this->template->assign("fields",$field);
        $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "salvarEditDadosEspecificos/".$parametro[2],"button"=>"Salvar"));
        $form = $this->template->fetch("form.tpl");

        $this->show($form);
    }

    /**
     * Edita os dados cadastrais da pessoa
     * da tabela pessoa
     */
    public function edit($parametro){

        $edit = PessoaModel::selectDataEdit($parametro[2]);

        try{
            $field[] =array("type"=>"progressbar","name"=>"progress","value"=>75,"label"=>"Progresso");
            $field[] =array("type"=>"hidden","name"=>"psa_cod","value"=>$edit["psa_cod"]);
            $field[] =array("type"=>"text","name"=>"psa_nome", "value"=>$edit["psa_nome"],"label"=>"Pessoa","required"=>true,"mensagem"=>"Favor informar o nome!");

            $ec = array(
                array("value"=>"C","label"=>"Casado(a)"),
                array("value"=>"S","label"=>"Solteiro(a)"),
                array("value"=>"UE","label"=>"União Estável")
            );
            $ecS = $this->setSelectedComboBox($ec, $edit["psa_estado_civil"]);

            $field[] =array("type"=>"select","name"=>"psa_estado_civil","label"=>"Estado Civil","option"=>$ecS,"required"=>true,"mensagem"=>"Favor informar o Estado Civil!");

            $escolaridade = PessoaModel::selectDataEscolaridade($edit["psa_cod"]);
            $field[] = array("type"=>"select","name"=>"psa_grau_instrucao","label"=>"Grau de Instrução","option"=>$escolaridade,"required"=>true,"mensagem"=>"Favor informar o Estado Civil!");

            $field[] = array("type"=>"label","label"=>"Profissão Atual","text"=>$edit["prof_nome"]);
            $field[] = array("type"=>"search","name"=>"prof_nome","label"=>"Profissão","url"=>"{$this->urlApp}Pessoa/AjaxProfissao/","nameHidden"=>"psa_profissao");
            $field[] =array("type"=>"hidden","name"=>"prof_cod","value"=>$edit["psa_profissao"]);

            for($x = date("Y"); $x>= 1989; $x--){
                $ano_membro[] = array("value"=>$x,"label"=>$x);
            }
            $ano_membro = $this->setSelectedComboBox($ano_membro, $edit["psa_ano_membro"]);
            $field[] =array("type"=>"select","name"=>"psa_ano_membro","label"=>"Membro desde","option"=>$ano_membro,"required"=>true,"mensagem"=>"Favor informar o Ano!");

            $sexo = array(
                array("value"=>"M","label"=>"Masculino"),
                array("value"=>"F","label"=>"Feminino")
            );
            $sexoS = $this->setSelectedComboBox($sexo, $edit["psa_sexo"]);
            $field[] =array("type"=>"select","name"=>"psa_sexo","label"=>"Sexo","option"=>$sexoS,"required"=>true,"mensagem"=>"Favor informar o Sexo!");

            $field[] =array("type"=>"date","name"=>"psa_data_nascimento", "value"=>$this->convertDate($edit["psa_data_nascimento"]),"label"=>"Data Nascimento","required"=>true,"mensagem"=>"Favor informar a data de nascimento!");
            $field[] =array("type"=>"text","name"=>"psa_rua", "value"=>$edit["psa_rua"],"label"=>"Logradouro","required"=>true,"mensagem"=>"Favor informar o endereço!");
            $field[] =array("type"=>"text","name"=>"psa_numero","value"=>$edit["psa_numero"],"label"=>"Número","required"=>true,"mensagem"=>"Favor informar o número!");
            $field[] =array("type"=>"text","name"=>"psa_bairro","value"=>$edit["psa_bairro"],"label"=>"Bairro","required"=>true,"mensagem"=>"Favor informar o bairro!");
            $field[] =array("type"=>"text","name"=>"psa_cidade","value"=>$edit["psa_cidade"],"label"=>"Cidade","required"=>true,"mensagem"=>"Favor informar a cidade!");

            $uf = array(array("value"=>"ES","label"=>"Espírito Santo"),);
            $ufS = $this->setSelectedComboBox($uf, $edit["psa_uf"]);
            $field[] =array("type"=>"select","name"=>"psa_uf","label"=>"UF","option"=>$ufS,"required"=>true,"mensagem"=>"Favor informar o UF!");

            $field[] =array("type"=>"text","name"=>"psa_cep","value"=>$edit["psa_cep"],"label"=>"CEP","required"=>true,"mensagem"=>"Favor informar o CEP!");
            $field[] =array("type"=>"text","name"=>"psa_telefone","value"=>$edit["psa_telefone"],"label"=>"Telefone","required"=>false);
            $field[] =array("type"=>"text","name"=>"psa_celular","value"=>$edit["psa_celular"],"label"=>"Celular","required"=>false);
            $field[] =array("type"=>"text","name"=>"psa_email","value"=>$edit["psa_email"],"label"=>"Email","required"=>false);
            $field[] =array("type"=>"textarea","name"=>"psa_observacao","value"=>$edit["psa_observacao"],"label"=>"Observação","required"=>false);

            $this->template->assign("fields",$field);
            $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "salvarEdit","button"=>"Salvar"));
            $form = $this->template->fetch("form.tpl");

            $this->show($form);
        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    public function formDadosCadastrais(){

        try{
            $field[] =array("type"=>"progressbar","name"=>"progress","value"=>75,"label"=>"Progresso");
            $field[] =array("type"=>"text","name"=>"psa_nome","label"=>"Pessoa","required"=>true,"mensagem"=>"Favor informar o nome!");

            $ec = array(
                array("value"=>"C","label"=>"Casado(a)"),
                array("value"=>"S","label"=>"Solteiro(a)"),
                array("value"=>"UE","label"=>"União Estável"),
                array("value"=>"V","label"=>"Viúvo(a)"),
                array("value"=>"D","label"=>"Divorciado(a)")
            );
            $field[] =array("type"=>"select","name"=>"psa_estado_civil","label"=>"Estado Civil","option"=>$ec,"required"=>true,"mensagem"=>"Favor informar o Estado Civil!");

            $escolaridade = PessoaModel::selectDataEscolaridade(0);
            $field[] =array("type"=>"select","name"=>"psa_grau_instrucao","label"=>"Grau de Instrução","option"=>$escolaridade,"required"=>true,"mensagem"=>"Favor informar o Estado Civil!");
            $field[] =array("type"=>"search","name"=>"prof_nome","label"=>"Profissão","url"=>"{$this->urlApp}Pessoa/AjaxProfissao/","nameHidden"=>"psa_profissao");

            for($x = date("Y"); $x>= 1989; $x--){
                $ano_membro[] = array("value"=>$x,"label"=>$x);
            }
            $field[] =array("type"=>"select","name"=>"psa_ano_membro","label"=>"Membro desde","option"=>$ano_membro,"required"=>true,"mensagem"=>"Favor informar o Ano!");

            $sexo = array(
                array("value"=>"M","label"=>"Masculino"),
                array("value"=>"F","label"=>"Feminino")
            );
            $field[] =array("type"=>"select","name"=>"psa_sexo","label"=>"Sexo","option"=>$sexo,"required"=>true,"mensagem"=>"Favor informar o Sexo!");

            $field[] =array("type"=>"search","name"=>"psa_cod_conjuge","label"=>"Cônjuge","url"=>"{$this->urlApp}Pessoa/AjaxPessoa/","nameHidden"=>"cod_membro");
            $field[] =array("type"=>"date","name"=>"psa_data_nascimento","label"=>"Data Nascimento","required"=>true,"mensagem"=>"Favor informar a data de nascimento!");
            $field[] =array("type"=>"text","name"=>"psa_rua","label"=>"Logradouro","required"=>true,"mensagem"=>"Favor informar o endereço!");
            $field[] =array("type"=>"text","name"=>"psa_numero","label"=>"Número","required"=>true,"mensagem"=>"Favor informar o número!");
            $field[] =array("type"=>"text","name"=>"psa_bairro","label"=>"Bairro","required"=>true,"mensagem"=>"Favor informar o bairro!");
            $field[] =array("type"=>"text","name"=>"psa_cidade","label"=>"Cidade","required"=>true,"mensagem"=>"Favor informar a cidade!");
            $uf = array(array("value"=>"ES","label"=>"Espírito Santo"),);
            $field[] =array("type"=>"select","name"=>"psa_uf","label"=>"UF","option"=>$uf,"required"=>true,"mensagem"=>"Favor informar o UF!");
            $field[] =array("type"=>"text","name"=>"psa_cep","label"=>"CEP","required"=>true,"mensagem"=>"Favor informar o CEP!");
            $field[] =array("type"=>"text","name"=>"psa_telefone","label"=>"Telefone","required"=>false);
            $field[] =array("type"=>"text","name"=>"psa_celular","label"=>"Celular","required"=>false);
            $field[] =array("type"=>"text","name"=>"psa_email","label"=>"Email","required"=>false);
            $field[] =array("type"=>"textarea","name"=>"psa_observacao","label"=>"Observação","required"=>false);

            $this->template->assign("fields",$field);
            $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "Salvar","button"=>"Salvar"));
            $form = $this->template->fetch("form.tpl");

            $this->show($form);
        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    public function setDadosEspecificos($parametro){

        setcookie("cel_cod", $_POST["cel_cod"], time()+600, "/IBANet", $_SERVER['SERVER_NAME']);

        setcookie("tipo_cod", $_POST["tipo_cod"], time()+600, "/IBANet", $_SERVER['SERVER_NAME']);

        if(is_array($_POST["fnc_cod"])){
            foreach ($_POST["fnc_cod"] as $id => $fnc_cod) {
                setcookie("fnc_cod[$id]", $fnc_cod, time()+600, "/IBANet", $_SERVER['SERVER_NAME']);
            }
        }

        if(is_array($_POST["mnt_cod"])){
            foreach ($_POST["mnt_cod"] as $id => $mnt_cod) {
                setcookie("mnt_cod[$id]", $mnt_cod, time()+600, "/IBANet", $_SERVER['SERVER_NAME']);
            }
        }

        if($parametro[2]){
            $this->go($this->urlController . "formDadosCadastraisEdit/".$parametro[2]);
        }else{
            $this->go($this->urlController . "formDadosCadastrais/");
        }
    }

    /**
     *
     */
    public function salvar(){

        try{
            $this->checkString($_POST["psa_nome"]);
            $this->checkNumeric($_COOKIE["tipo_cod"]);
            $this->checkString($_POST["cod_membro"]);
            $this->checkString($_POST["psa_rua"]);
            $this->checkNumeric($_POST["psa_numero"]);
            $this->checkString($_POST["psa_bairro"]);
            $this->checkString($_POST["psa_cidade"]);
            $this->checkNumeric($_POST["psa_cep"]);
            $this->checkNumeric($_POST["psa_telefone"]);
            $this->checkNumeric($_POST["psa_celular"]);

            $cod_membro = $_POST["cod_membro"];

            if(!is_numeric($cod_membro)){
                $cod_membro = NULL;
            }

            if(empty($_POST["psa_profissao"])){
                $_POST["psa_profissao"] = NULL;
            }

            $data = array(
                $_COOKIE["tipo_cod"],
                $cod_membro,
                $_POST["psa_nome"],
                $_POST["psa_data_nascimento"],
                $_POST["psa_estado_civil"],
                $_POST["psa_grau_instrucao"],
                $_POST["psa_profissao"],
                $_POST["psa_ano_membro"],
                $_POST["psa_sexo"],
                $_POST["psa_rua"],
                $_POST["psa_numero"],
                $_POST["psa_bairro"],
                $_POST["psa_cidade"],
                $_POST["psa_uf"],
                $_POST["psa_cep"],
                $_POST["psa_telefone"],
                $_POST["psa_celular"],
                $_POST["psa_email"],
                $_POST["psa_observacao"]
            );

            if(!isset($_COOKIE["cel_cod"])){
                throw new PDOException("COOKIES:: Sessão expirada, você demorou muito!");
            }

            PessoaModel::$model->beginTransaction();

            if(PessoaModel::insert($data)){

                PessoaModel::setCodConjuge($data[1], PessoaModel::$codPessoa);

                if(isset($_COOKIE["fnc_cod"])){
                    foreach ($_COOKIE["fnc_cod"] as $fnc_cod) {
                        PessoaModel::setFuncaoPessoa($fnc_cod, PessoaModel::$codPessoa);
                    }
                }

                if(isset($_COOKIE["mnt_cod"])){
                    foreach ($_COOKIE["mnt_cod"] as $mnt_cod) {
                        PessoaModel::setMinisterioPessoa($mnt_cod, PessoaModel::$codPessoa);
                    }
                }

                if(is_numeric($_COOKIE["cel_cod"])){
                    PessoaModel::setCelulaPessoa(PessoaModel::$codPessoa, $_COOKIE["cel_cod"]);
                }

                $this->splash("Pessoa salvo com sucesso: " . PessoaModel::$codPessoa);
                $this->go($this->urlController);
            }

            PessoaModel::$model->commit();
        }catch (PDOException $e){
            PessoaModel::$model->rollBack();
            $this->splash("Tentativa falhou! Tente novamente: " . $e->getMessage());
            $this->go($this->urlController);
        }
    }

    /**
     *
     */
    public function salvarEdit(){

        try{
            $this->checkString($_POST["psa_nome"]);
            $this->checkString($_POST["psa_rua"]);
            $this->checkNumeric($_POST["psa_numero"]);
            $this->checkString($_POST["psa_bairro"]);
            $this->checkString($_POST["psa_cidade"]);
            $this->checkNumeric($_POST["psa_cep"]);
            $this->checkNumeric($_POST["psa_telefone"]);
            $this->checkNumeric($_POST["psa_celular"]);

            if(empty($_POST["psa_profissao"])){
                $_POST["psa_profissao"] = $_POST["prof_cod"];
            }

            $data = array(
                $_POST["psa_nome"],
                $this->convertDate($_POST["psa_data_nascimento"], "mysql"),
                $_POST["psa_estado_civil"],
                $_POST["psa_grau_instrucao"],
                $_POST["psa_profissao"],
                $_POST["psa_ano_membro"],
                $_POST["psa_sexo"],
                $_POST["psa_rua"],
                $_POST["psa_numero"],
                $_POST["psa_bairro"],
                $_POST["psa_cidade"],
                $_POST["psa_uf"],
                $_POST["psa_cep"],
                $_POST["psa_telefone"],
                $_POST["psa_celular"],
                $_POST["psa_email"],
                $_POST["psa_observacao"],
                $_POST["psa_cod"]
            );

            PessoaModel::$model->beginTransaction();

            if(PessoaModel::update($data)){
                $this->splash("Dados da pessoa salvo com sucesso PSA: " . $_POST["psa_cod"]);
                $this->go($this->urlController);
            }

            PessoaModel::$model->commit();
        }catch (PDOException $e){
            PessoaModel::$model->rollBack();
            $this->splash("Tentativa falhou! Tente novamente: " . $e->getMessage());
            $this->go($this->urlController);
        }
    }

    public function salvarEditDadosEspecificos(){
        try{

            $this->checkNumeric($_POST["psa_cod"]);
            $this->checkNumeric($_POST["tipo_cod"]);
            $this->checkNumeric($_POST["cel_cod"]);

            PessoaModel::$model->beginTransaction();

            PessoaModel::delFuncaoPessoa($_POST["psa_cod"]);
            PessoaModel::delMinisterioPessoa($_POST["psa_cod"]);
            PessoaModel::delCelulaPessoa($_POST["psa_cod"]);
            PessoaModel::updateTipoPessoa($_POST["tipo_cod"], $_POST["psa_cod"]);

            if(isset($_POST["fnc_cod"])){
                foreach ($_POST["fnc_cod"] as $fnc_cod) {
                    PessoaModel::setFuncaoPessoa($fnc_cod, $_POST["psa_cod"]);
                }
            }

            PessoaModel::setCelulaPessoa($_POST["psa_cod"], $_POST["cel_cod"]);

            if(isset($_POST["mnt_cod"])){
                foreach ($_POST["mnt_cod"] as $mnt_cod) {
                    PessoaModel::setMinisterioPessoa($mnt_cod, $_POST["psa_cod"]);
                }
            }

            PessoaModel::$model->commit();

            $this->splash("Pessoa: Edição dados específica Realizada com sucesso!");
            $this->go($this->urlController."editDadosEspecificos/".$_POST["psa_cod"]);

        } catch (PDOException $e) {
            PessoaModel::$model->rollBack();
            $this->splash("Pessoa: Falha na edição! Tente novamente: " . $e->getMessage());
            $this->go($this->urlController."editDadosEspecificos/".$_POST["psa_cod"]);
        }
    }

    /**
     *
     * @return type
     */
    public function grid(){

        try{
            $grid = new DeiaGrid("psa_cod", $this->urlController, 10);

            if(empty($grid->postGrid["exibir"])){
                $grid->numRegisterTotal = PessoaModel::selectDataTotalRegister();
                $grid->postGrid["exibir"] = $grid->numRegisterTotal;
            }else{
                $grid->numRegisterTotal = $grid->postGrid["exibir"];
            }

            $grid->dataGrid = PessoaModel::selectData($grid->start, $grid->limit);
            $grid->urlPagination = $this->urlController;
            $grid->urlPagination = $this->urlController."Grid/";

            $gridMenu[] = array("href"=>$this->urlController."Edit/","label"=>"Editar Dados Gerais","icon"=>"fa-edit");
            $gridMenu[] = array("href"=>$this->urlController."editDadosEspecificos/","label"=>"Editar Dados IBA","icon"=>"fa-asterisk");
            $gridMenu[] = array("href"=>$this->urlController."View/","label"=>"Visualizar","icon"=>"fa-archive");
            $grid->gridMenu = $gridMenu;

            $grid->setColumnGrid(array("label"=>"#","field"=>"link","align"=>"center"));
            $grid->setColumnGrid(array("label"=>"Nome","field"=>"psa_nome","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Email","field"=>"psa_email","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Telefone","field"=>"psa_telefone","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Celular","field"=>"psa_celular","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Célula","field"=>"cel_nome","class"=>"","title"=>""));

            $this->show($grid->gridFetch());

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    public function view($parametro){

        $view = PessoaModel::selectDataView($parametro[2]);

        $this->template->assign("title",$view["psa_nome"] . " - " .$view["psa_cod"]);
        $this->template->assign("subTitle",$this->convertDate($view["psa_data_nascimento"]));
        $this->template->assign("dateTime",date("d/m/Y H:i:s"));

        $section[] = array(
            "title"=>"Dados Pessoais",
            "item"=>array(
                array("label"=>"Estado Civil","value"=>$this->getEstadoCivil($view["psa_estado_civil"])),
                array("label"=>"Sexo","value"=>$this->getSexo($view["psa_sexo"])),
                array("label"=>"Data de Nascimento","value"=>$this->convertDate($view["psa_data_nascimento"])),
                array("label"=>"Cônjuge","value"=>$view["conjuge"]),
                array("label"=>"Observação","value"=>$view["psa_observacao"]),
            ),
        );
        $section[] = array(
            "title"=>"Endereço",
            "item"=>array(
                array("label"=>"Logradouro","value"=>$view["psa_rua"]),
                array("label"=>"Número","value"=>$view["psa_numero"]),
                array("label"=>"Bairro","value"=>$view["psa_bairro"]),
                array("label"=>"Cidade","value"=>$view["psa_cidade"]),
                array("label"=>"UF","value"=>$view["psa_uf"]),
                array("label"=>"CEP","value"=>$view["psa_cep"]),
            ),
        );
        $section[] = array(
            "title"=>"Contato",
            "item"=>array(
                array("label"=>"Telefone","value"=>$view["psa_telefone"]),
                array("label"=>"Celular","value"=>$view["psa_celular"]),
                array("label"=>"Email","value"=>$view["psa_email"])
            ),
        );

        $this->template->assign("section", $section);
        $view = $this->template->fetch("view.tpl");

        $this->template->assign("subcaption","Dados detalhados do registro.");
        $this->show($view);
    }

    public function ajaxPessoa(){
        $post = $_POST["data"];
        try{
            $result = PessoaModel::selectPessoaAjax($post);
            if(!empty($result)){
                echo json_encode($result);
            }else{
                echo json_encode(array(array("value"=>"NENHUM RESULTADO ENCONTRADO")));
            }
        }catch (InvalidArgumentException $e){
            echo json_encode(array("value"=>$e->getMessage()));
        }
    }

    public function ajaxProfissao(){
        $post = $_POST["data"];
        try{
            $result = PessoaModel::selectProfissao($post);
            if(!empty($result)){
                echo json_encode($result);
            }else{
                echo json_encode(array(array("value"=>"NENHUM RESULTADO ENCONTRADO")));
            }
        }catch (InvalidArgumentException $e){
            echo json_encode(array("value"=>$e->getMessage()));
        }
    }
}
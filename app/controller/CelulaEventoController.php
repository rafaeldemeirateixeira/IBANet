<?php

/**
 * Class controller
 */

class CelulaEventoController extends DeiaController{

    /**
     * Url do controlador
     * @var type
     */
    protected $urlController = null;

    public function __construct(){
        DeiaAuthenticate::check(true);
        parent::__construct(true);
        $this->urlController = $this->urlApp . "CelulaEvento/";
        $this->template->assign("caption","Cadastro dos eventos de celula");
        $this->template->assign("subcaption","Destina-se ao cadastro semanal dos eventos de cada célula");

        //Habilita os botoes para adicionar e listar dados
        $action["add"] = array("enable"=>true,"href"=>$this->urlController."add/");
        $action["list"] = array("enable"=>true,"href"=>$this->urlController);
        $this->template->assign("action", $action);

        new CelulaEventoModel();
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
            $select = CelulaEventoModel::selectComboBox(0);
            $field[] =array("type"=>"select","name"=>"cel_cod","label"=>"Célula","required"=>true,"option"=>$select);
            $field[] =array("type"=>"date","name"=>"cel_evt_data","label"=>"Data","required"=>true,"mensagem"=>"Favor informar a data do evento!");

            $hora = array(
                array("value"=>"17:00:00","label"=>"17:00"),
                array("value"=>"18:00:00","label"=>"18:00"),
                array("value"=>"19:00:00","label"=>"19:00"),
                array("value"=>"19:30:00","label"=>"19:30"),
                array("value"=>"20:00:00","label"=>"20:00")
            );
            $field[] =array("type"=>"select","name"=>"cel_evt_hora","label"=>"Hora","required"=>true,"option"=>$hora);
            $field[] =array("type"=>"textarea","name"=>"cel_evt_endereco","label"=>"Endereço","required"=>true,"mensagem"=>"Informe o endereço","obs"=>"Ex: Avenida Barra Nova, 14 Vale Encantado, Vila Velha - ES");
            $field[] =array("type"=>"text","name"=>"cel_evt_latlon","label"=>"Latitude & Longitude","required"=>true,"mesagem"=>"Informe a Latitue e Longitude","obs"=>"Obter no <a href='https://maps.google.com' target='_blank'>Google Maps</a>");
            $field[] =array("type"=>"textarea","name"=>"cel_evt_obs","label"=>"Observações","required"=>0);

            $this->template->assign("fields",$field);
            $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController . "Salvar","button"=>"Salvar"));
            $form = $this->template->fetch("form.tpl");

            $this->show($form);

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    public function edit($parametro){

        $cel_evt_cod = $parametro[2];
        $edit = CelulaEventoModel::selectDataView($cel_evt_cod);

        if($edit["cel_evt_presenca"] == 1){
            $this->splash("A presença deste evento já foi computada");
            $this->go($this->urlController);
        }

        $this->template->assign("caption","::/@ Eventos de Célula / Edição / {$edit["cel_nome"]}");
        $this->template->assign("subcaption","Atualiza os eventos semanais de cada célula.<br>ATENÇÃO: Não é possível altualizar eventos que já foram realizados!");

        try{
            $field[] = array("type"=>"hidden","name"=>"cel_evt_cod","value"=>$edit["cel_evt_cod"]);
            $select = CelulaEventoModel::selectComboBox($cel_evt_cod);
            $field[] =array("type"=>"select","name"=>"cel_cod","label"=>"Célula","required"=>true,"option"=>$select);
            $field[] =array("type"=>"date","name"=>"cel_evt_data","value"=>$this->convertDate($edit["cel_evt_data"]),"label"=>"Data","required"=>true,"mensagem"=>"Favor informar a data do evento!");

            $hora = array(
                array("value"=>"17:00:00","label"=>"17:00"),
                array("value"=>"18:00:00","label"=>"18:00"),
                array("value"=>"19:00:00","label"=>"19:00"),
                array("value"=>"19:30:00","label"=>"19:30"),
                array("value"=>"20:00:00","label"=>"20:00")
            );
            $hora = $this->setSelectedComboBox($hora, $edit["cel_evt_hora"]);
            $field[] =array("type"=>"select","name"=>"cel_evt_hora","label"=>"Hora","required"=>true,"option"=>$hora);
            $field[] =array("type"=>"textarea","name"=>"cel_evt_endereco","value"=>$edit["cel_evt_endereco"],"label"=>"Endereço","required"=>true,"mensagem"=>"Informe o endereço","obs"=>"Ex: Avenida Barra Nova, 14 Vale Encantado, Vila Velha - ES");
            $field[] =array("type"=>"text","name"=>"cel_evt_latlon","value"=>$edit["cel_evt_latlon"],"label"=>"Latitude/Longitude","required"=>true,"obs"=>"Obter no <a href='https://maps.google.com' target='_blank'>Google Maps</a>");
            $field[] =array("type"=>"textarea","name"=>"cel_evt_obs","value"=>$edit["cel_evt_obs"],"label"=>"Observações","required"=>0);

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
            $this->checkString($_POST["cel_evt_endereco"]);
            $this->checkString($_POST["cel_evt_obs"]);
            $this->checkNumeric($_POST["cel_cod"]);

            if(empty($_POST["cel_evt_latlon"])){
                $_POST["cel_evt_latlon"] = NULL;
            }

            $data = array(
                $_POST["cel_cod"],
                $_POST["cel_evt_data"],
                $_POST["cel_evt_hora"],
                $_POST["cel_evt_endereco"],
                $_POST["cel_evt_latlon"],
                $_POST["cel_evt_obs"]
            );
            if(CelulaEventoModel::insert($data)){
                $this->splash("Evento salvo com sucesso");
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
            $this->checkString($_POST["cel_evt_endereco"]);
            $this->checkString($_POST["cel_evt_obs"]);
            $this->checkNumeric($_POST["cel_cod"]);
            $this->checkNumeric($_POST["cel_evt_cod"]);

            if(empty($_POST["cel_evt_latlon"])){
                $_POST["cel_evt_latlon"] = NULL;
            }

            $data = array(
                $_POST["cel_cod"],
                $this->convertDate($_POST["cel_evt_data"], "mysql"),
                $_POST["cel_evt_hora"],
                $_POST["cel_evt_endereco"],
                $_POST["cel_evt_latlon"],
                $_POST["cel_evt_obs"],
                $_POST["cel_evt_cod"]
            );

            if(CelulaEventoModel::update($data)){
                $this->splash("Evento atualizado com sucesso");
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
     * @return void
     */
    public function grid(){
        try{
            $grid = new DeiaGrid("cel_evt_cod", $this->urlController, 10);

            if(empty($grid->postGrid["exibir"])){
                $grid->numRegisterTotal = CelulaEventoModel::selectDataTotalRegister();
                $grid->postGrid["exibir"] = $grid->numRegisterTotal;
            }else{
                $grid->numRegisterTotal = $grid->postGrid["exibir"];
            }

            $gridMenu[] = array("href"=>$this->urlController."Edit/","label"=>"Editar Evento","icon"=>"fa-edit");
            $gridMenu[] = array("href"=>$this->urlController."View/","label"=>"Visualizar Evento","icon"=>"fa-archive");
            $gridMenu[] = array("href"=>$this->urlController."../CelulaPresenca/","label"=>"Lista de Presença","icon"=>"fa-archive");
            $grid->gridMenu = $gridMenu;

            $grid->setColumnGrid(array("label"=>"#","field"=>"link","align"=>"center"));
            $grid->setColumnGrid(array("label"=>"Célula","field"=>"cel_nome","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Data","field"=>"cel_evt_data","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Hora","field"=>"cel_evt_hora","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Dia","field"=>"cel_evt_dia","class"=>"","title"=>""));

            $grid->dataGrid = CelulaEventoModel::selectData($grid->start, $grid->limit);

            $this->show($grid->gridFetch());

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    public function view($parametro){
        $this->template->assign("subcaption","Descrição detalhada do evento.");

        $view = CelulaEventoModel::selectDataView($parametro[2]);

        $this->template->assign("title",$view["cel_nome"] . " - " .$view["cel_cod"]);
        $this->template->assign("subTitle",$view["cel_observacao"]);
        $this->template->assign("dateTime",date("d/m/Y H:i:s"));

        $section[] = array(
            "title"=>"Dados do Evento",
            "item"=>array(
                array("label"=>"Data/Hora","value"=>$this->convertDate($view["cel_evt_data"])." - ". $view["cel_evt_hora"]),
                array("label"=>"Endereço","value"=>$view["cel_evt_endereco"]),
                array("label"=>"Observação","value"=>$view["cel_evt_obs"]),
                array("mapa"=>true,"latlon"=>$view["cel_evt_latlon"])
            ),
        );

        $this->template->assign("section", $section);
        $view = $this->template->fetch("view.tpl");

        $this->show($view);
    }
}
<?php

/**
 * Class controller
 */

class CelulaPresencaController extends DeiaController
{

    private $urlController = NULL;

    public function __construct(){
        DeiaAuthenticate::check(true);
        parent::__construct(true);
        $this->urlController = $this->urlApp . "CelulaPresenca/";
        $this->template->assign("caption","Lista de presença");
        $this->template->assign("subcaption","Lista todos os participantes da célula cadastrados no IBANet para marcação de presença.");

        //Habilita os botoes para adicionar e listar dados
        $action["add"] = array("enable"=>true,"href"=>$this->urlApp."CelulaEvento/add/");
        $action["list"] = array("enable"=>true,"href"=>$this->urlApp."CelulaEvento/");
        $this->template->assign("action", $action);

        new CelulaPresencaModel();
    }


    public function index($data){

        try {
            $this->lista($data);
        } catch (SmartyException $e) {
            echo $e->getMessage();
        }
    }

    public function lista($data){
        try{
            $lista = CelulaPresencaModel::selectData($data[1]);

            if(is_array($lista) && !empty($lista)){

                $evento = CelulaPresencaModel::selectDataEvento($data[1]);

                $field[] = array("type"=>"label","label"=>"Célula","text"=>$evento["cel_nome"]);
                $field[] = array("type"=>"label","label"=>"Data-Hora","text"=>$this->convertDate($evento["cel_evt_data"])." - ".$evento["cel_evt_hora"]);
                $field[] = array("type"=>"label","label"=>"Endereço","text"=>$evento["cel_evt_endereco"]);
                $field[] = array("type"=>"label","label"=>"Observação","text"=>$evento["cel_evt_obs"]);
                foreach ($lista as $value) {
                    $field[] =array("type"=>"checkbox","name"=>"psa_cod[]","value"=>$value["psa_cod"],"label"=>"[".$value["psa_cod"]."] ".$value["psa_nome"]." - [".$value["nivel"]."]");
                }

                $this->template->assign("fields",$field);
                $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlController."Salvar/".$data[1],"button"=>"Salvar","confirm"=>true));
                $form = $this->template->fetch("form.tpl");
                $this->show($form);
            }else{
                $this->grid($data[1]);
            }

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    /**
     *
     * @param type $data
     */
    public function salvar($data){

        try{
            $presenca = $_POST["psa_cod"];
            $lista = CelulaPresencaModel::selectData($data[2]);

            foreach ($lista as $value) {
                if(is_array($presenca) && array_search($value["psa_cod"], $presenca) !== false){
                    $presente = 1;
                }else{
                    $presente = 0;
                }

                $array = array($value["psa_cod"],$data[2],$presente);

                CelulaPresencaModel::insert($array);
            }

            CelulaPresencaModel::setEventoPresenca($data[2]);

            $this->splash("Lista salva com sucesso!");
            $this->go($this->urlApp."CelulaEvento");
        }catch(PDOException $e){
            $this->splash($e->getMessage());
        }
    }

    /**
     *
     * @return void
     */
    public function grid($cel_evt_cod){
        try{
            $grid = new DeiaGrid("psa_cod", $this->urlController, 10);

            if(empty($grid->postGrid["exibir"])){
                $grid->numRegisterTotal = CelulaPresencaModel::selectDataTotalRegister($cel_evt_cod);
                $grid->postGrid["exibir"] = $grid->numRegisterTotal;
            }else{
                $grid->numRegisterTotal = $grid->postGrid["exibir"];
            }

            $grid->setColumnGrid(array("label"=>"#","field"=>"link","align"=>"center"));
            $grid->setColumnGrid(array("label"=>"Data/Hora","field"=>"cel_fqc_data","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Nome","field"=>"psa_nome","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Celula","field"=>"cel_nome","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Nivel","field"=>"nivel","class"=>"","title"=>""));
            $grid->setColumnGrid(array("label"=>"Presente","field"=>"presente","class"=>"","title"=>""));

            $grid->dataGrid = CelulaPresencaModel::selectDataPresenca($cel_evt_cod, $grid->start, $grid->limit);

            $this->show($grid->gridFetch());

        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }
}
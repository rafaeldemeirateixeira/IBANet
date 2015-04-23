<?php

/**
 * Class controller
 */

class IndexController extends DeiaController
{

    public function __construct(){
        DeiaAuthenticate::check(true);
        parent::__construct(true);
        //new IndexModel();
    }


    public function index(){

        try {
            $this->go($this->urlApp."Pessoa/");

        } catch (SmartyException $e) {
            echo $e->getMessage();
        }
    }

    public function form(){
        try{
            $field[] =array("type"=>"text","name"=>"nome","label"=>"Nome");
            $field[] =array("type"=>"search","name"=>"membros","label"=>"Membros","url"=>"$this->urlApp/Index/Ajax/","nameHidden"=>"cod_membro");
            $field[] =array("type"=>"search","name"=>"visitante","label"=>"Visitante","url"=>"$this->urlApp/Index/Ajax/","nameHidden"=>"cod_visitante");
            $select = array(
                array("value"=>"123","label"=>"Alimento"),
                array("value"=>"456","label"=>"Roupas"),
                array("value"=>"876","label"=>"Serviços"),
                array("value"=>"765","label"=>"Lazer")
            );
            $field[] =array("type"=>"select","name"=>"categoria","label"=>"Categoria","option"=>$select);
            $field[] =array("type"=>"textarea","name"=>"obs","label"=>"Observações");
            $field[] =array("type"=>"file","name"=>"arquivo","label"=>"Foto");
            $field[] =array("type"=>"password","name"=>"senha","label"=>"Senha");

            $this->template->assign("fields",$field);
            $this->template->assign("form",array("name"=>"formulario","method"=>"post","action"=>$this->urlApp));
            $form = $this->template->fetch("form.tpl");

            $this->template->assign("content",$form);
            $this->template->display("home.tpl");
        }catch(InvalidArgumentException $e){
            echo $e->getMessage();
        }
    }

    public function ajax(){
        $arr = array(); //Declaração da variável array
        //Atribuição dos valores na posição correspondente no array
        $post = $_POST["data"];

        $data[] = array("id"=>"1001","value"=>"Rafael de Meira Teixeira");
        $data[] = array("id"=>"1002","value"=>"Rafael Cosme");
        $data[] = array("id"=>"1003","value"=>"Rafael Paz Almeida");
        $data[] = array("id"=>"1004","value"=>"Andreia Luiza Araujo");
        $data[] = array("id"=>"1005","value"=>"Andreia Bianchi");
        $data[] = array("id"=>"1006","value"=>"Leonardo Ramos");
        $data[] = array("id"=>"1007","value"=>"Leonardo Oliveira");

        $result = NULL;
        foreach ($data as $value) {
            $pos = strripos($value["value"], $post);
            if($pos !== false){
                $result[] = $value;
            }
        }

        if($result == NULL){
            $result[] = array("value"=>"Nenhum resultado encontrado");
        }

        //A função json_encode() converte um array para o formato JSON
        echo json_encode($result);
    }

    public function save(){
        echo "Salvation is here!";
    }

    public function date(){
        IndexModel::getDateTime();
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
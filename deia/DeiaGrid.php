<?php

class DeiaGrid extends DeiaController
{
    /**
     * Numero de colunas da tabela
     * @var int
     */
    public $numColumn = 0;

    /**
     * Numero de linhas da tabela
     * @var int
     */
    public $numLine = 0;

    /**
     * Template para renderizar o grid
     * @var string
     */
    public $tpl = "grid.tpl";

    /**
     * Recebe o vetor com os dados da primeira linha do grid.
     * @var array
     */
    private $columnGrid = array();

    /**
     * Chave primária da tabela
     * @var int
     */
    public $keyGrid = "";

    /**
     * Recebe o post do formulario com os dados do Grid
     * @var type array
     */
    public $postGrid = NULL;

    /**
     * Nome do controloador referente ao grid
     * @var string
     */
    private $controllerGrid = "";

    /**
     * Número total de registro a ser exibido
     * @var int
     */
    public $numRegisterTotal = 999;

    /**
     * Número de registro por página
     * @var int
     */
    public $numRegisterPage = 1;

    /**
     * número de registro retornados pela consulta
     * que monta o Grid
     * @var type int
     */
    public $numRegisterResult = 0;

    /**
     * Vetor contendo os registros do grid
     * @var array
     */
    public $dataGrid = array();

    public $gridMenu = NULL;

    public $fieldAdd = NULL;

    public $start = 0;

    public $limit = 0;

    public function __construct($keyGrid, $controllerGrid, $numForPage = 1)
    {
        $this->keyGrid = $keyGrid;
        $this->controllerGrid = $controllerGrid;
        $this->postGrid = $_POST;
        $this->numRegisterPage = $numForPage;

        /**
         * Define o intervalo inicial do limit
         * Caso tenha sido feito POST entra no else
         */
        if(empty($this->postGrid["pgn"])){
            $this->start = 0;
            $this->limit = $this->numRegisterPage;
        }else{
            $str = explode(",", $this->postGrid["pgn"]);
            $this->start = intval($str[0]);
            $this->limit = intval($str[1]);
        }

        if(!empty($this->postGrid["reg_page"])){
            $this->numRegisterPage = $this->postGrid["reg_page"];

            if($this->postGrid["reg_page"] != $this->limit){
                $this->start = 0;
                $this->limit = $this->postGrid["reg_page"];
            }
        }

        parent::__construct(true);
    }

    /**
     * Exibe o html gerado pelo grid.
     */
    public function gridSplash()
    {
        $this->numColumn = count($this->columnGrid);

        $this->template->assign("host", $this->urlApp);
        $this->template->assign("controller", $this->controllerGrid);
        $this->template->assign("pagination", $this->createPagination($this->numRegisterTotal, $this->numRegisterPage));
        $this->template->assign("keyGrid", $this->keyGrid);
        $this->template->assign("numColumn", $this->numColumn);
        $this->template->assign("dataGrid", $this->dataGrid);
        $this->template->assign("grid", $this->columnGrid);
        $this->template->assign("fieldAdd", $this->fieldAdd);

        $this->template->display($this->tpl);
    }

    /**
     * Renderiza o html contendo o grid formatado
     */
    public function gridFetch()
    {
        $this->numColumn = count($this->columnGrid) + 1;

        $this->template->assign("host", $this->urlApp);
        $this->template->assign("controller", $this->controllerGrid);
        $this->template->assign("pagination", $this->createPagination($this->numRegisterPage, $this->numRegisterTotal, $this->postGrid["pgn"]));
        $this->template->assign("keyGrid", $this->keyGrid);
        $this->template->assign("numColumn", $this->numColumn);
        $this->template->assign("dataGrid", $this->dataGrid);
        $this->template->assign("grid", $this->columnGrid);
        $this->template->assign("fieldAdd", $this->fieldAdd);
        $this->template->assign("gridMenu", $this->gridMenu);
        $this->template->assign("form", $this->postGrid);

        return $this->template->fetch($this->tpl);
    }

    /**
     * Seta array na variavel $columnGrid
     * @param array $column
     */
    public function setColumnGrid($column){
        try{
            DeiaController::checkArray($column);
            $this->columnGrid[] = $column;
        }  catch (InvalidArgumentException $e){
            error_log($e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Define o valor de $dataGrid. Vetor de dados
     * @param array $data
     */
    public function setDataGrid($data){
        try {
            DeiaController::checkArray($data);
            $this->dataGrid[] = $data;
        } catch (InvalidArgumentException $e) {
            error_log($e->getMessage());
            echo $e->getMessage();
        }
    }

    /**
     * Monta as paginas do grid
     * @param int $numForPage
     * @param int $numTotalRegister
     */
    public function createPagination($numForPage, $numTotalRegister, $position){
        (int)$pages = intval($numTotalRegister / $numForPage);
        $resto = $numTotalRegister%$numForPage;
        if($resto != 0){
            $pages = $pages + 1;
        }

        $x = 0;
        $i = 1;
        $reg = 2;
        $atual = intval(substr($position, 0, 1));
        $start = $atual - ($numForPage * $reg);
        $stop = $atual + ($numForPage * $reg);

        if(empty($start) || $start < 0){
            $start = 0;
        }

        while($i <= $pages){
            if($x >= $start && $x <= $stop){
                $row[] = array("value"=>$x.",".$numForPage,"label"=>$i);
            }
            $x = $x + $numForPage;
            $i++;
        }

        return $row;
    }
}
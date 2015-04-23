<?php

/**
 * Class controller
 */
class TestController extends DeiaController
{

    /**
     * Url do controlador
     * @var type
     */
    protected $urlController = null;

    public function __construct()
    {
        parent::__construct(false);

        $this->debugging = false;
        $this->left_delimiter = "{";
        $this->right_delimiter = "}";
        $this->template_dir = ROOT . "/app/view/template/test/";
        $this->compile_dir = ROOT . "/app/view/compiler/";
        $this->config_dir = ROOT . "/app/view/config/";
        $this->cache_dir = ROOT . "/app/view/cache/";
        $this->assign("host", $this->urlApp);
        $this->assign("hostImage", $this->urlApp . "public/image/");
    }

    public function index()
    {
        try {
            //$this->display("countdown.tpl");
            #Informamos as datas e horários de início e fim no formato Y-m-d H:i:s e os convertemos para o formato timestamp
            $dia_hora_atual = strtotime(date("Y-m-d H:i:s"));
            $dia_hora_evento = strtotime(date("2015-04-23 15:55:00"));

            #Achamos a diferença entre as datas...
            $diferenca = $dia_hora_evento - $dia_hora_atual;

            #Fazemos a contagem...
            $marcador = $diferenca % 86400;
            $hora = intval($marcador / 3600);
            $marcador = $marcador % 3600;
            $minuto = str_pad(intval($marcador / 60), 2, "0", STR_PAD_LEFT);
            $segundos = str_pad($marcador % 60, 2, "0", STR_PAD_LEFT);

            #Exibimos o resultado
            echo "0$hora:$minuto:$segundos<br>";
            echo $diferenca;

        } catch (SmartyException $exc) {
            echo $exc->getTraceAsString();
        }
    }

}

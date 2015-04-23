<?php

class LogoutController extends DeiaController{
    public function __construct(){
        parent::__construct(true);
    }

    public function index(){
        $crypter = new \src\Crypter();
        $psa_cod = $crypter->decrypt($_COOKIE["psa_cod"]);

        $log = json_encode(array("Logout","Index", $_COOKIE["time_session"]));
        DeiaModel::setLogSistema($psa_cod, $this->ip(), $log);

        DeiaAuthenticate::logout();
    }
}
<?php

class NotFoundController extends DeiaController{
    public function __construct() {
        parent::__construct(true);
    }
    
    public function index(){
        $this->template->display("404.tpl");
    }
}
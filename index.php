<?php

header ('Content-type: text/html; charset=UTF-8');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

require_once 'boot.php';

$className = FILE;

if(!file_exists(ROOT . DS . "app" . DS . "controller" . DS . FILE . ".php")){
    $className = "NotFoundController";
}

$page = new $className;
$page->renderPage($page);
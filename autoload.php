<?php

function auto_carregamento($className){
    $file = str_replace('\\', '/', $className . '.php');

    $smarty = substr($file, 0, 6);

    //echo $smarty;

    if($smarty == "Smarty" && $file != "Smarty.php"){
        $file = strtolower($file);
    }

    if($file != "src.php"){
        require_once $file;
    }

    if(!class_exists($className)){
        throw new InvalidArgumentException("Classe inexistente - " . $className);
    }
}

spl_autoload_register('auto_carregamento');
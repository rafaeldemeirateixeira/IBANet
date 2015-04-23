<?php

/**
 * Description of IndexModel
 * @author rafael
 */

class IndexModel {

    private static $indexModel = null;


    public function __construct() {
        self::$indexModel = DeiaModel::PDOInstance();
    }

    public static function getDateTime(){
        $qwy = self::$indexModel->query("SELECT NOW() AS datetime");
        $fetch = $qwy->fetch();

        var_export($fetch);
    }

    
}
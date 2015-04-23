<?php
/**
 * @author Rafael de Meira Teixeira <rafael@ibalianca.com.br>
 * @copyright (c) 2013, Rafael de Meira Teixeira
 * @package deiaFramework
 */

date_default_timezone_set('America/Sao_Paulo');

$params = isset($_GET['params']) ? explode('/', $_GET['params']) : array("Index");

define('HOST', "http://" . $_SERVER['SERVER_NAME']);
define('PORT', $_SERVER['SERVER_PORT']);
define('ROOT', dirname(__FILE__));
define('FILE', $params[0] . "Controller");
define('DS', DIRECTORY_SEPARATOR);

set_include_path(implode(PATH_SEPARATOR, array(
    get_include_path(),
    ROOT,
    ROOT . DS . "app",
    ROOT . DS . "app" . DS . "controller",
    ROOT . DS . "app" . DS . "model",
    ROOT . DS . "app" . DS . "view",
    ROOT . DS . "deia",
    ROOT . DS . "src",
    ROOT . DS . "src" . DS . "plugins",
    ROOT . DS . "src" . DS . "plugins" . DS . "smarty" . DS . "libs",
    ROOT . DS . "src" . DS . "plugins" . DS . "smarty" . DS . "libs" . DS . "sysplugins",
    ROOT . DS . "config",
)));

require ROOT . DS . 'autoload.php';
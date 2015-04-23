<?php

class DataBaseConfig
{
	public static $config = array(
            "drive" => "mysql",
            "host" => "localhost",
            "user" => "rafaeldemeirat",
            "password" => "andreia3007",
            "port" => "3306",
            "database" => "ibanet",
            "options" => array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_CASE => PDO::CASE_LOWER,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                //PDO::ATTR_AUTOCOMMIT => FALSE
            )
        );
}
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DeiaAuthenticate
 *
 * @author rafael
 */
class DeiaAuthenticate {
    public static function check($action){
        if($action){
            if((!isset($_COOKIE["psa_email"]) || !isset($_COOKIE["psa_pwd"])) || $_COOKIE["psa_pwd"] != $_COOKIE["authentic"].":".md5(date("Y<>m-%d"))){
                header("location:http://".$_SERVER['SERVER_NAME']."/IBANet/Login");
            }
        }
    }

    public static function logout(){
        setcookie("authentic", "", time()-86400, "/IBANet", $_SERVER['SERVER_NAME']);
        setcookie("psa_email", "", time()-86400, "/IBANet", $_SERVER['SERVER_NAME']);
        setcookie("psa_pwd", "", time()-86400, "/IBANet", $_SERVER['SERVER_NAME']);
        setcookie("time_session", "", time()-86400, "/IBANet", $_SERVER['SERVER_NAME']);

        header("location:http://".$_SERVER['SERVER_NAME']."/IBANet/Login");
    }

    public static function clearCookie(){
        setcookie("authentic", "", time()-86400, "/IBANet", $_SERVER['SERVER_NAME']);
        setcookie("psa_email", "", time()-86400, "/IBANet", $_SERVER['SERVER_NAME']);
        setcookie("psa_pwd", "", time()-86400, "/IBANet", $_SERVER['SERVER_NAME']);
        setcookie("time_session", "", time()-86400, "/IBANet", $_SERVER['SERVER_NAME']);
    }
}
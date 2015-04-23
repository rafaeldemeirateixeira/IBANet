<?php

class LoginModel{

    private static $model = null;

    public function __construct(){
        self::$model = DeiaModel::PDOInstance();
    }

    /**
     *
     * @param type $data
     */
    public static function checkLogin($psa_email, $psa_pwd){

        $qwy = self::$model->prepare(
            "SELECT COUNT(psa_cod) AS total, psa_cod FROM pessoa WHERE psa_email = ? AND psa_pwd = ? AND psa_status = 1 AND psa_ibanet = 1"
        );
        if($qwy->execute(array($psa_email, $psa_pwd))){
            $result = $qwy->fetch(PDO::FETCH_ASSOC);
            if($result["total"] == 1){
                return $result;
            }
            return false;
        }else{
            throw new InvalidArgumentException("Error na consulta checkLogin");
        }

        return false;
    }

    public static function selectDataEmail($email){
        $qwy = self::$model->prepare(
            "SELECT psa_cod, psa_nome, psa_email FROM pessoa WHERE psa_email = ? AND psa_status = 1 AND psa_ibanet = 1"
        );
        if($qwy->execute(array($email))){
            return $qwy->fetch(PDO::FETCH_ASSOC);
        }
    }

    public static function getTimeDiff($time){
        $qwy = self::$model->prepare("SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND, NOW(), ?)) AS time, TIMESTAMPDIFF(SECOND, NOW(), ?) AS segundos");
        if($qwy->execute(array($time,$time))){
            return $qwy->fetch(PDO::FETCH_ASSOC);
        }
    }
}

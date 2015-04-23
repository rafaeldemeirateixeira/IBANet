<?php

class CelulaPresencaModel{

    private static $model = null;

    public function __construct(){
        self::$model = DeiaModel::PDOInstance();
    }

    public static function selectData($cel_evt_cod){
        $qwy = self::$model->prepare(
        "
            SELECT P.psa_cod, P.psa_nome,
            'Participante' AS nivel
            FROM celula_evento CE
            INNER JOIN celula_pessoa CP ON CP.cel_cod = CE.cel_cod
            INNER JOIN pessoa P ON P.psa_cod = CP.psa_cod
            WHERE CE.cel_evt_cod = ? AND cel_evt_presenca = 0
        "
        );
        if($qwy->execute(array($cel_evt_cod))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public static function selectDataEvento($cel_evt_cod){
        $qwy = self::$model->prepare(
        "
            SELECT
                cel_evt_endereco,
                cel_evt_obs,
                cel_evt_data,
                cel_evt_hora,
                cel_nome
            FROM celula_evento CE
            INNER JOIN celula C ON C.cel_cod = CE.cel_cod
            WHERE CE.cel_evt_cod = ?
        "
        );
        if($qwy->execute(array($cel_evt_cod))){
            return $qwy->fetch(PDO::FETCH_ASSOC);
        }
    }

    public static function selectDataPresenca($cel_evt_cod, $start, $max){
        $qwy = self::$model->prepare(
        "
            SELECT
                CF.psa_cod,
                DATE_FORMAT(CF.cel_fqc_data, '%d/%m/%Y %H:%i:%s') AS cel_fqc_data,
                P.psa_nome,
                C.cel_nome,
                'Participante' AS nivel,
                IF(CF.cel_fqc_presente = 1, 'Sim','Não') AS presente
            FROM celula_frequencia CF
                INNER JOIN pessoa P ON P.psa_cod = CF.psa_cod
                INNER JOIN celula_evento CE ON CE.cel_evt_cod = CF.cel_evt_cod
                INNER JOIN celula C ON C.cel_cod = CE.cel_cod
                INNER JOIN celula_pessoa CP ON CP.psa_cod = CF.psa_cod

            WHERE CF.cel_evt_cod = ? AND cel_evt_presenca = 1
            LIMIT $start, $max
        "
        );
        if($qwy->execute(array($cel_evt_cod))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public static function selectDataTotalRegister($cel_evt_cod){
        $qwy = self::$model->prepare(
        "
            SELECT
                COUNT(psa_cod) AS total
            FROM celula_frequencia CF
                INNER JOIN celula_evento CE ON CE.cel_evt_cod = CF.cel_evt_cod
            WHERE CF.cel_evt_cod = ? AND cel_evt_presenca = 1
        "
        );
        if($qwy->execute(array($cel_evt_cod))){
            $result = $qwy->fetch(PDO::FETCH_ASSOC);
            return $result["total"];
        }
    }

    /**
     *
     * @param type $data
     */
    public static function insert($data){

        $qwy = self::$model->prepare(
            "INSERT INTO `celula_frequencia`(
                `psa_cod`,
                `cel_evt_cod`,
                `cel_fqc_data`,
                `cel_fqc_presente`
            )
            VALUES (
                ?, ?, TIMESTAMP(NOW()), ?
            )"
        );
        if (is_array($data)){
            return $qwy->execute($data);
        }
    }

    public static function setEventoPresenca($cel_evt_cod, $cel_evt_presenca = 1){
        $qwy = self::$model->prepare(
            "
            UPDATE celula_evento SET cel_evt_presenca = ? WHERE cel_evt_cod = ?
            "
        );
        if($qwy->execute(array($cel_evt_presenca, $cel_evt_cod))){
            return true;
        }

        return false;
    }
}

<?php

class CelulaFuncaoModel{

    public static $model = null;

    public function __construct(){
        self::$model = DeiaModel::PDOInstance();
    }

    public static function selectData($start, $max){
        $qwy = self::$model->prepare(
            "
            SELECT
            CONCAT_WS('CP', CP.cel_cod, CP.psa_cod) AS cel_psa_cod,
                cel_nome,
                CASE
                    WHEN funcao = 1 THEN 'Líder'
                    WHEN funcao = 2 THEN 'Supervisor'
                    WHEN funcao = 3 THEN 'Coordenador'
                ELSE
                    'N/A'
                END AS fnc_nome,
                psa_nome
            FROM celula_funcao CP
            INNER JOIN pessoa P ON P.psa_cod = CP.psa_cod
            INNER JOIN celula C ON C.cel_cod = CP.cel_cod
            WHERE funcao IN(1,2,3)
            ORDER BY cel_nome
            LIMIT $start, $max
            "
        );
        if($qwy->execute()){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public static function selectDataTotalRegister(){
        $qwy = self::$model->prepare(
            "
            SELECT COUNT(psa_cod) AS total
            FROM celula_funcao C
            "
        );
        if($qwy->execute()){
            $result = $qwy->fetch(PDO::FETCH_ASSOC);
            return $result["total"];
        }
    }

    public static function selectDataEdit($psa_cod){
        $qwy = self::$model->prepare(
            "
            SELECT
                psa_nome,
                funcao
            FROM celula_funcao CF
            INNER JOIN pessoa P ON P.psa_cod = CF.psa_cod
            WHERE
            CF.psa_cod = ?
            GROUP BY funcao
            "
        );
        if($qwy->execute(array($psa_cod))){
            return $qwy->fetch(PDO::FETCH_ASSOC);
        }
    }

    /**
     *
     * @param type $data
     */
    public static function selectComboBox($cod){

        $qwy = self::$model->prepare(
            "
                SELECT
                    C.cel_cod AS value,
                    cel_nome AS label,
                    IF(
                        (SELECT CP.cel_cod
                        FROM celula_funcao CP
                        WHERE
                            CP.cel_cod = C.cel_cod
                            AND psa_cod = ?) = C.cel_cod, 1, 0
                    ) AS selected
                FROM
                    celula C
                WHERE
                    cel_status = 1
            "
        );
        if($qwy->execute(array($cod))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }else{
            throw new InvalidArgumentException("Error na consulta Ministerio selectComboBox");
        }
    }

     /**
     * Seleciona todos os psa_cod
     * @param type $data
     */
    public static function selectPsaCod($cel_cod, $funcao){

        $qwy = self::$model->prepare(
            "
                SELECT CP2.psa_cod, CP2.cel_cod, CP2.funcao
                FROM celula_funcao CP
                INNER JOIN celula_funcao CP2 ON CP2.psa_cod = CP.psa_cod
                WHERE CP.cel_cod = ?
                AND CP.funcao = ?
            "
        );
        if($qwy->execute(array($cel_cod, $funcao))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }else{
            throw new InvalidArgumentException("Error na consulta selectPsaCod");
        }
    }

    public static function setCelulaPessoa($psa_cod, $cel_cod, $nivel){
        $qwy = self::$model->prepare(
            "INSERT INTO celula_funcao("
                . "cel_cod,"
                . "psa_cod,"
                . "funcao"
                . ")"
                . "VALUES("
                . "?,?,?"
                . ")"
        );
        if($qwy->execute(array($cel_cod, $psa_cod, $nivel))){
            return true;
        }

        return false;
    }

    /**
     * Remove todas as funcoes de célula amarradas ao PSA_COD informado
     * @param type $psa_cod
     */
    public static function delCelulaPessoaPSA($psa_cod){
        $qwy = self::$model->prepare(
            "DELETE FROM celula_funcao WHERE psa_cod = ?"
        );
        if($qwy->execute(array($psa_cod))){
            return true;
        }

        return false;
    }

    /**
     * Remove todas as funcoes de célula amarradas ao CEL_COD e nivel informado
     * @param int $cel_cod
     * @param int $nivel
     */
    public static function delCelulaPessoaCelNiv($cel_cod, $nivel){
        $qwy = self::$model->prepare(
            "DELETE FROM celula_funcao WHERE cel_cod = ? AND funcao = ?"
        );
        if($qwy->execute(array($cel_cod, $nivel))){
            return true;
        }

        return false;
    }

    /**
     * Remove uma função da pessoa
     * @param type $cel_cod
     * @param type $psa_cod
     * @return boolean
     */
    public static function delCelulaFuncaoPsaCel($cel_cod, $psa_cod){
        $qwy = self::$model->prepare(
            "DELETE FROM celula_funcao WHERE cel_cod = ? AND psa_cod = ?"
        );
        if($qwy->execute(array($cel_cod, $psa_cod))){
            return true;
        }

        return false;
    }
}
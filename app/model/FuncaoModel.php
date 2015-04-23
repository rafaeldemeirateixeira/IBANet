<?php

class FuncaoModel{

    private static $model = null;

    public function __construct(){
        self::$model = DeiaModel::PDOInstance();
    }

    /**
     *
     * @param type $data
     */
    public static function selectComboBox($cod){

        $qwy = self::$model->prepare(
            "
                SELECT
                    F.fnc_cod AS value,
                    fnc_nome AS label,
                    IF(
                        (SELECT FP.fnc_cod
                        FROM funcao_pessoa FP
                        WHERE
                            FP.fnc_cod = F.fnc_cod
                            AND FP.psa_cod = ?) = F.fnc_cod, 1, 0
                    ) AS selected
                FROM
                    funcao F
                ORDER BY F.fnc_nome ASC
            "
        );
        if($qwy->execute(array($cod))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }else{
            throw new InvalidArgumentException("Error na consulta Ministerio selectComboBox");
        }
    }

    public static function selectDataTotalRegister(){
        $qwy = self::$model->prepare(
            "
            SELECT COUNT(fnc_cod) AS total
            FROM funcao
            "
        );
        if($qwy->execute()){
            $result = $qwy->fetch(PDO::FETCH_ASSOC);
            return $result["total"];
        }
    }

    public static function selectData($start, $max){
        $qwy = self::$model->prepare(
            "
            SELECT
                F.fnc_cod,
                F.fnc_nome,
                F2.fnc_nome AS fnc_nome_pai
            FROM funcao F
            LEFT JOIN funcao F2 ON F2.fnc_cod = F.fnc_cod_pai
            ORDER BY F.fnc_nome
            LIMIT $start, $max
            "
        );
        if($qwy->execute()){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public static function selectDataEdit($fnc_cod){
        $qwy = self::$model->prepare(
            "
            SELECT
                F.fnc_cod,
                F.fnc_cod_pai,
                F.fnc_nome
            FROM funcao F
            WHERE F.fnc_cod = ?
            "
        );
        if($qwy->execute(array($fnc_cod))){
            return $qwy->fetch(PDO::FETCH_ASSOC);
        }
    }

    /**
     *
     * @param type $data
     */
    public static function insert($data){
        if (count($data) != 2){
            throw new InvalidArgumentException("Numero de parametros != 2X");
        }

        $qwy = self::$model->prepare(
            "INSERT INTO `funcao`(
                `fnc_cod_pai`,
                `fnc_nome`
            )
            VALUES (
                ?, ?
            )"
        );
        if (is_array($data)){
            return $qwy->execute($data);
        }
    }

    /**
     *
     * @param type $data
     */
    public static function update($data){
        if (count($data) != 3){
            throw new InvalidArgumentException("Numero de parametros != 3X");
        }

        $qwy = self::$model->prepare(
            "UPDATE funcao SET
                fnc_cod_pai = ?,
                fnc_nome = ?
            WHERE
                fnc_cod = ?
            "
        );
        if (is_array($data)){
            return $qwy->execute($data);
        }
    }
}

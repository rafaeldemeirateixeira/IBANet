<?php

class PessoaTipoModel extends DeiaModel{

    public static $model = null;

    public function __construct(){
        self::$model = DeiaModel::PDOInstance();
    }

    /**
     *
     * @return type
     */
    public static function selectAll($cod){
        $qwy = self::$model->prepare(
            "
                SELECT
                    PT.tipo_cod AS value,
                    tipo_nome AS label,
                    IF(
                        (SELECT P.tipo_cod
                        FROM pessoa P
                        WHERE
                            psa_cod = ?) = PT.tipo_cod, 1, 0
                    ) AS selected
                FROM
                    pessoa_tipo PT
                WHERE
                    tipo_status = 1
                ORDER BY tipo_nome
            "
        );
        if($qwy->execute(array($cod))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }

    public static function selectData($start, $max){
        $qwy = self::$model->prepare(
            "
            SELECT tipo_cod, tipo_nome
            FROM pessoa_tipo
            ORDER BY tipo_nome
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
            SELECT COUNT(tipo_cod) AS total
            FROM pessoa_tipo
            "
        );
        if($qwy->execute()){
            $result = $qwy->fetch(PDO::FETCH_ASSOC);
            return $result["total"];
        }
    }

    public static function selectDataEdit($tipo_cod){
        $qwy = self::$model->prepare(
            "
            SELECT tipo_cod, tipo_nome
            FROM pessoa_tipo
            WHERE tipo_cod = ?
            "
        );
        if($qwy->execute(array($tipo_cod))){
            return $qwy->fetch(PDO::FETCH_ASSOC);
        }
    }

    /**
     *
     * @param type $data
     */
    public static function insert($data){

        if (count($data) != 1){
            throw new InvalidArgumentException("Numero de parametros != 1");
        }

        $qwy = self::$model->prepare(
            "INSERT INTO `pessoa_tipo` (
                `tipo_nome`
            )
            VALUES (
                ?
            )"
        );

        if (is_array($data)){
            if($qwy->execute($data)){
                return true;
            }
        }

        return false;
    }

    /**
     *
     * @param type $data
     */
    public static function update($tipo_cod, $tipo_nome){

        $qwy = self::$model->prepare(
            "
                UPDATE pessoa_tipo SET
                    tipo_nome = ?
                WHERE
                    tipo_cod = ?
            "
        );

        if($qwy->execute(array($tipo_nome, $tipo_cod))){
            return true;
        }

        return false;
    }

    public static function delete($tipo_cod){
        $qwy = self::$model->prepare(
            "
                DELETE FROM pessoa_tipo WHERE tipo_cod = ?
            "
        );

        if($qwy->execute(array($tipo_cod))){
            return true;
        }

        return false;
    }
}

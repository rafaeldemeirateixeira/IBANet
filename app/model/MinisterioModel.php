<?php

class MinisterioModel{

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
                    mnt_cod AS value,
                    mnt_nome AS label,
                    IF(
                        (SELECT MP.mnt_cod
                        FROM ministerio_pessoa MP
                        WHERE
                            MP.mnt_cod = M.mnt_cod
                            AND psa_cod = ?) = M.mnt_cod, 1,0
                    ) AS selected
                FROM ministerio M
                WHERE mnt_status = 1
                ORDER BY mnt_nome ASC
            "
        );
        if($qwy->execute(array($cod))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }else{
            throw new InvalidArgumentException("Error na consulta Ministerio selectComboBox");
        }
    }

    /**
     *
     * @param type $data
     */
    public static function selectMinisterioAjax($data){

        $qwy = self::$model->prepare(
            "SELECT mnt_cod AS id, mnt_nome AS value FROM ministerio WHERE mnt_nome = ?"
        );
        if($qwy->execute(array($data))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }else{
            throw new InvalidArgumentException("Error na consulta Ministerio Ajax");
        }
    }

    /**
     *
     * @param type $data
     */
    public static function insert($data){
        if (count($data) != 5){
            throw new InvalidArgumentException("Numero de parametros != 5");
        }

        $qwy = self::$model->prepare(
            "INSERT INTO `ministerio`(
                `mnt_cod_pai`,
                `psa_cod`,
                `mnt_nome`,
                `mnt_data_nascimento`,
                `mnt_observacao`,
                mnt_status
            )
            VALUES (
                ?, ?, ?, STR_TO_DATE(?,'%d/%m/%Y'), ?, 1
            )"
        );
        if (is_array($data)){
            return $qwy->execute($data);
        }
    }
}

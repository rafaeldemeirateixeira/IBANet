<?php

class PessoaTipoModel extends DeiaModel{

    private static $pessoaTipoModel = null;

    public function __construct(){
        self::$pessoaTipoModel = DeiaModel::PDOInstance();
    }

    /**
     *
     * @param type $data
     */
    public static function insert($data){

        if (count($data) != 1){
            throw new InvalidArgumentException("Numero de parametros != 1");
        }

        $qwy = self::$pessoaTipoModel->prepare(
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
     * @return type
     */
    public static function selectAll($cod){
        $qwy = self::$pessoaTipoModel->prepare(
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
}

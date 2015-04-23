<?php

class CelulaModel{

    private static $model = null;

    public function __construct(){
        self::$model = DeiaModel::PDOInstance();
    }

    public static function selectData($start, $max){
        $qwy = self::$model->prepare(
            "
            SELECT C.cel_cod, cel_nome, cel_dia, COUNT( CP.psa_cod ) AS pessoas
            FROM celula C
            LEFT JOIN celula_pessoa CP ON CP.cel_cod = C.cel_cod
            GROUP BY 1
            ORDER BY C.cel_nome
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
            SELECT COUNT(cel_cod) AS total
            FROM celula C
            "
        );
        if($qwy->execute()){
            $result = $qwy->fetch(PDO::FETCH_ASSOC);
            return $result["total"];
        }
    }

    public static function selectDataView($cel_cod){
        $qwy = self::$model->prepare(
            "
            SELECT
                C.*,
                CC.cel_nome AS cel_pai,
                GROUP_CONCAT(P.psa_nome) AS psa_nome,
                GROUP_CONCAT(funcao) AS nivel
            FROM celula C
            LEFT JOIN celula CC ON CC.cel_cod = C.cel_cod_pai
            LEFT JOIN celula_funcao CP ON CP.cel_cod = C.cel_cod
            LEFT JOIN pessoa P ON P.psa_cod = CP.psa_cod
            WHERE
                C.cel_cod = ?
                AND funcao IN(1,2)
            "
        );
        if($qwy->execute(array($cel_cod))){
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
                        (SELECT C2.cel_cod FROM celula_pessoa C2
                        WHERE C2.psa_cod = ?) = C.cel_cod,1,0
                    ) AS selected
                FROM
                    celula C
                WHERE
                    cel_status = 1

                ORDER BY cel_nome ASC
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
    public static function selectComboBoxCelulaPai($cod){

        $qwy = self::$model->prepare(
            "
                SELECT
                    C.cel_cod AS value,
                    cel_nome AS label,
                    IF(
                        (SELECT CP.cel_cod_pai
                        FROM celula CP
                        WHERE
                            CP.cel_cod = ?) = C.cel_cod, 1, 0
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
     *
     * @param type $data
     */
    public static function insert($data){
        if (count($data) != 5){
            throw new InvalidArgumentException("Numero de parametros != 5X");
        }

        $qwy = self::$model->prepare(
            "INSERT INTO `celula`(
                `cel_cod_pai`,
                `cel_nome`,
                `cel_dia`,
                `cel_data_nascimento`,
                `cel_observacao`,
                cel_status
            )
            VALUES (
                ?, ?, ?, STR_TO_DATE(?,'%d/%m/%Y'), ?, 1
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
        if (count($data) != 6){
            throw new InvalidArgumentException("Numero de parametros != 6X");
        }

        $qwy = self::$model->prepare(
            "
                UPDATE celula SET
                    cel_cod_pai = ?,
                    cel_nome = ?,
                    cel_dia = ?,
                    cel_data_nascimento = STR_TO_DATE(?,'%d/%m/%Y'),
                    cel_observacao = ?
                WHERE cel_cod = ?
            "
        );
        if (is_array($data)){
            return $qwy->execute($data);
        }
    }
}
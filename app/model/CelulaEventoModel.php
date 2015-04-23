<?php

class CelulaEventoModel{

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
                C.cel_cod AS value,
                cel_nome AS label,
                IF(
                    (SELECT CE.cel_cod FROM celula_evento CE WHERE cel_evt_cod = ?) = C.cel_cod,
                    1,0
                ) AS selected
                FROM celula C
                WHERE cel_status = 1
            "
        );
        if($qwy->execute(array($cod))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }else{
            throw new InvalidArgumentException("Error na consulta Ministerio selectComboBox");
        }
    }

    public static function selectData($start, $max){
        $qwy = self::$model->prepare(
        "
            SELECT
                cel_evt_cod,
                C.cel_nome,
                DATE_FORMAT(cel_evt_data,'%d/%m/%Y') AS cel_evt_data,
                cel_evt_hora,
                CASE
                    WHEN DATE_FORMAT(cel_evt_data,'%W') = 'Saturday' THEN 'Sábado'
                    WHEN DATE_FORMAT(cel_evt_data,'%W') = 'Tuesday' THEN 'Terça'
                ELSE
                    DATE_FORMAT(cel_evt_data,'%W')
                END AS cel_evt_dia
            FROM celula_evento CE
            INNER JOIN celula C ON C.cel_cod = CE.cel_cod
            ORDER BY cel_evt_data DESC
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
            SELECT COUNT(cel_evt_cod) AS total
            FROM celula_evento CE
            INNER JOIN celula C ON C.cel_cod = CE.cel_cod
            "
        );
        if($qwy->execute()){
            $result = $qwy->fetch(PDO::FETCH_ASSOC);
            return $result["total"];
        }
    }

    public static function selectDataView($cel_evt_cod){
        $qwy = self::$model->prepare(
            "
            SELECT CE.*, C.cel_nome
            FROM celula_evento CE
            INNER JOIN celula C ON C.cel_cod = CE.cel_cod
            WHERE
            CE.cel_evt_cod = ?
            "
        );
        if($qwy->execute(array($cel_evt_cod))){
            return $qwy->fetch(PDO::FETCH_ASSOC);
        }
    }

    /**
     *
     * @param type $data
     */
    public static function insert($data){

        $qwy = self::$model->prepare(
            "INSERT INTO `celula_evento`(
                `cel_cod`,
                `cel_evt_data`,
                `cel_evt_hora`,
                `cel_evt_endereco`,
                `cel_evt_latlon`,
                `cel_evt_obs`,
                `cel_evt_presenca`
            )
            VALUES (
                ?, STR_TO_DATE(?,'%d/%m/%Y'), ?, ?, ?, ?, 0
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

        $qwy = self::$model->prepare(
            "UPDATE celula_evento SET
                cel_cod = ?,
                cel_evt_data = ?,
                cel_evt_hora = ?,
                cel_evt_endereco = ?,
                cel_evt_latlon = ?,
                cel_evt_obs = ?
            WHERE
                cel_evt_cod = ?
                AND cel_evt_presenca = 0
            "
        );
        if (is_array($data)){
            return $qwy->execute($data);
        }
    }
}

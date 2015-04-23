<?php

class MenuModel{

    public static $model = null;

    public function __construct(){
        self::$model = DeiaModel::PDOInstance();
    }

    /**
     * Seleciona os registro para montar o menu conforme
     * codigo do usuario
     * @param array $data
     */
    public static function selectData($cod){

        $qwy = self::$model->prepare(
            "
                SELECT M.*
                FROM menu M
                INNER JOIN menu_pessoa MP ON MP.menu_cod = M.menu_cod
                WHERE MP.psa_cod = ?
                ORDER BY menu_nome ASC
            "
        );
        if($qwy->execute(array($cod))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }else{
            throw new InvalidArgumentException("Error na consulta Menu");
        }
    }

    /**
     * Seleciona os registro para montar o menu conforme
     * codigo do usuario
     * @param array $data
     */
    public static function selectDataTree(){

        $qwy = self::$model->prepare(
            "
                SELECT menu_nome AS label, menu_cod AS value, menu_cod_pai, menu_topico
                FROM menu
                ORDER BY menu_topico ASC
            "
        );
        if($qwy->execute(array($cod))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }else{
            throw new InvalidArgumentException("Error na consulta Menu");
        }
    }

    /**
     *
     * @param type $data
     */
    public static function selectDataGrid($start, $max){

        $qwy = self::$model->prepare(
            "
                SELECT psa_cod, psa_nome FROM pessoa WHERE psa_status = 1 LIMIT $start, $max
            "
        );
        if($qwy->execute(array($cod))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }else{
            throw new InvalidArgumentException("Error na consulta Menu");
        }
    }

    public static function selectDataTotalRegister(){
        $qwy = self::$model->prepare(
            "
                SELECT COUNT(psa_cod) AS total
                FROM pessoa
                WHERE psa_status = 1
            "
        );

        if($qwy->execute()){
            $fetch = $qwy->fetch(PDO::FETCH_ASSOC);

            return $fetch["total"];
        }
    }

    /**
     *
     * @param type $data
     */
    public static function selectDataEdit($psa_cod){

        $qwy = self::$model->prepare(
            "
                SELECT psa_cod, psa_email, psa_nome, psa_ibanet FROM pessoa WHERE psa_cod = ?
            "
        );
        if($qwy->execute(array($psa_cod))){
            return $qwy->fetch(PDO::FETCH_ASSOC);
        }else{
            throw new InvalidArgumentException("Error na consulta Menu");
        }
    }

    /**
     *
     * @param type $data
     */
    public static function selectComboBoxMenu($psa_cod){

        $qwy = self::$model->prepare(
            "
                SELECT
                    menu_cod AS value,
                    CONCAT_WS(' - ', menu_topico, menu_nome) AS label,
                    IF(
                        (SELECT MP.menu_cod
                        FROM menu_pessoa MP
                        WHERE
                            MP.menu_cod = M.menu_cod
                            AND psa_cod = ?) = M.menu_cod, 1,0
                    ) AS selected
                FROM menu M
                ORDER BY menu_topico
            "
        );
        if($qwy->execute(array($psa_cod))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }else{
            throw new InvalidArgumentException("Error na consulta Ministerio selectComboBox");
        }
    }

    public static function updateIBANetPessoa($status, $psa_cod){
        $qwy = self::$model->prepare(
            "
             UPDATE pessoa SET psa_ibanet = ? WHERE psa_cod = ?
            "
        );
        if($qwy->execute(array($status, $psa_cod))){
            return true;
        }

        return false;
    }

    public static function insertMenu($menu_cod, $psa_cod){
        $qwy = self::$model->prepare(
            "
             INSERT INTO menu_pessoa(
                menu_cod,
                psa_cod
             )
             VALUES(?, ?)
            "
        );
        if($qwy->execute(array($menu_cod, $psa_cod))){
            return true;
        }

        return false;
    }

    public static function deleteMenu($psa_cod){
        $qwy = self::$model->prepare(
            "
             DELETE FROM menu_pessoa WHERE psa_cod = ?
            "
        );
        if($qwy->execute(array($psa_cod))){
            return true;
        }

        return false;
    }
}
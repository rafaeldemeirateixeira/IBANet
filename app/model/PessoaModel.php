<?php

class PessoaModel
{

    public static $logErro = null;
    public static $model = null;
    public static $codPessoa = null;
    public static $rowNumber = 0;

    public function __construct()
    {
        self::$model = DeiaModel::PDOInstance();
    }

    public static function selectData($start, $max){
        $qwy = self::$model->prepare(
            "
                SELECT P.psa_cod, psa_nome, psa_email, psa_telefone, psa_celular, cel_nome
                FROM pessoa P
                LEFT JOIN celula_pessoa CP ON CP.psa_cod = P.psa_cod
                LEFT JOIN celula C ON C.cel_cod = CP.cel_cod
                WHERE psa_status = 1
                ORDER BY psa_nome ASC
                LIMIT $start, $max
            "
        );

        if($qwy->execute()){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    /**
     * Retorna o total de registros
     * @return type
     */
    public static function selectDataTotalRegister(){
        $qwy = self::$model->prepare(
            "
                SELECT COUNT(psa_cod) AS total
                FROM pessoa P
                WHERE psa_status = 1
            "
        );

        if($qwy->execute()){
            $fetch = $qwy->fetch(PDO::FETCH_ASSOC);

            return $fetch["total"];
        }
    }

    public static function selectDataEdit($cod){
        $qwy = self::$model->prepare(
            "
            SELECT P.*, PF.prof_nome
            FROM pessoa P
            LEFT JOIN profissao PF ON PF.prof_cod = P.psa_profissao
            WHERE psa_cod = ?
            "
        );
        if($qwy->execute(array($cod))){
            return $qwy->fetch(PDO::FETCH_ASSOC);
        }
    }

    public static function selectDataView($cod){
        $qwy = self::$model->prepare(
            "
            SELECT P.*, PP.psa_nome AS conjuge
            FROM pessoa P
            LEFT JOIN pessoa PP ON PP.psa_cod = P.psa_cod_conjuge
            WHERE P.psa_cod = ?
            "
        );
        if($qwy->execute(array($cod))){
            return $qwy->fetch(PDO::FETCH_ASSOC);
        }
    }

    public static function selectDataEscolaridade($cod){
        $qwy = self::$model->prepare(
            "
            SELECT
                esc_cod AS value,
                esc_nome AS label,
                IF(
                    (
                    SELECT P.psa_grau_instrucao
                    FROM pessoa P
                    WHERE
                    P.psa_cod = ?
                    ) = esc_cod, 1, 0
                ) AS selected
            FROM escolaridade
            ORDER BY esc_nome ASC
            "
        );
        if($qwy->execute(array($cod))){
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    /**
     *
     * @param type $data
     */
    public static function insert($data)
    {
        new CelulaModel();
        new FuncaoModel();
        new MinisterioModel();

        try {
            if (count($data) != 19) {
                throw new InvalidArgumentException("Numero de parametros != 19");
            }

            //self::$model->beginTransaction();

            $qwy = self::$model->prepare(
                "INSERT INTO `pessoa`(
                    `tipo_cod` ,
                    `psa_cod_conjuge`,
                    `psa_nome` ,
                    `psa_data_nascimento` ,
                    `psa_estado_civil` ,
                    `psa_grau_instrucao`,
                    `psa_profissao`,
                    `psa_ano_membro`,
                    `psa_sexo` ,
                    `psa_rua` ,
                    `psa_numero` ,
                    `psa_bairro` ,
                    `psa_cidade` ,
                    `psa_uf` ,
                    `psa_cep` ,
                    `psa_telefone` ,
                    `psa_celular` ,
                    `psa_email` ,
                    `psa_observacao` ,
                    `psa_ibanet` ,
                    `psa_status`,
                    `psa_data_cadastro`
                )
                VALUES (
                    ?, ?, ?, STR_TO_DATE(?,'%d/%m/%Y'), ?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', '1', DATE(NOW())
                )"
            );
            $qwy->execute($data);

            self::$codPessoa = self::$model->lastInsertId();

            return true;

        } catch (PDOException $e1) {
            self::$logErro[] = $e1;

            return false;
        }
    }

    public static function update($data){
        $qwy = self::$model->prepare(
            "
            UPDATE pessoa SET
                psa_nome = ?,
                psa_data_nascimento = ?,
                psa_estado_civil = ?,
                psa_grau_instrucao = ?,
                psa_profissao = ?,
                psa_ano_membro = ?,
                psa_sexo = ?,
                psa_rua = ?,
                psa_numero = ?,
                psa_bairro = ?,
                psa_cidade = ?,
                psa_uf = ?,
                psa_cep = ?,
                psa_telefone = ?,
                psa_celular = ?,
                psa_email = ?,
                psa_observacao = ?
            WHERE
                psa_cod = ?
            "
        );
        if($qwy->execute($data)){
            return true;
        }

        return false;
    }

    public static function updateTipoPessoa($tipo_cod, $psa_cod){
        $qwy = self::$model->prepare(
            "
            UPDATE pessoa SET
                tipo_cod = ?
            WHERE
                psa_cod = ?
            "
        );
        if($qwy->execute(array($tipo_cod, $psa_cod))){
            return true;
        }

        return false;
    }

    public static function updatePasswordPessoa($password, $psa_cod){
        $qwy = self::$model->prepare(
            "
            UPDATE pessoa SET
                psa_pwd = ?
            WHERE
                psa_cod = ?
            "
        );
        if($qwy->execute(array($password, $psa_cod))){
            return true;
        }

        return false;
    }

    public static function selectPessoaAjax($data)
    {
        $qwy = self::$model->prepare(
                "SELECT psa_cod AS id, psa_nome AS value FROM pessoa WHERE psa_nome LIKE ? ORDER BY psa_nome"
        );
        if ($qwy->execute(array("%" . $data . "%"))) {
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new InvalidArgumentException("Error na consulta Ajax");
        }
    }

    public static function selectProfissao($data)
    {
        $qwy = self::$model->prepare(
                "SELECT prof_cod AS id, prof_nome AS value FROM profissao WHERE prof_nome LIKE ? ORDER BY prof_nome"
        );
        if ($qwy->execute(array("%" . $data . "%"))) {
            return $qwy->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new InvalidArgumentException("Error na consulta Ajax");
        }
    }

    public static function setCodConjuge($psa_cod, $psa_cod_conjuge)
    {
        $qwy = self::$model->prepare(
                "SELECT psa_cod_conjuge FROM pessoa WHERE psa_cod = ?"
        );
        if ($qwy->execute(array($psa_cod))) {
            $result = $qwy->fetch(PDO::FETCH_ASSOC);
            if (is_null($result["psa_cod_conjuge"])) {

                $up = self::$model->prepare(
                    "UPDATE pessoa SET psa_cod_conjuge = ? WHERE psa_cod = ?"
                );
                if ($up->execute(array($psa_cod_conjuge, $psa_cod))) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function setCelulaPessoa($psa_cod, $cel_cod){
        $qwy = self::$model->prepare(
            "INSERT INTO celula_pessoa("
                . "cel_cod,"
                . "psa_cod"
                . ")"
                . "VALUES("
                . "?,?"
                . ")"
        );
        if($qwy->execute(array($cel_cod, $psa_cod))){
            return true;
        }

        return false;
    }

    public static function setMinisterioPessoa($mnt_cod, $psa_cod){
        $qwy = self::$model->prepare(
            "INSERT INTO ministerio_pessoa("
                . "mnt_cod,"
                . "psa_cod"
                . ")"
                . "VALUES("
                . "?,?"
                . ")"
        );
        if($qwy->execute(array($mnt_cod, $psa_cod))){
            return true;
        }

        return false;
    }

    public static function setFuncaoPessoa($fnc_cod, $psa_cod){
        $qwy = self::$model->prepare(
            "INSERT INTO funcao_pessoa(
                fnc_cod,
                psa_cod
                )
                VALUES(
                ?,?
                )"
        );
        if($qwy->execute(array($fnc_cod, $psa_cod))){
            return true;
        }

        return false;
    }

    /**
     * Remove todas as funcoes amarradas ao PSA_COD informado
     * @param type $psa_cod
     */
    public static function delFuncaoPessoa($psa_cod){
        $qwy = self::$model->prepare(
            "DELETE FROM funcao_pessoa WHERE psa_cod = ?"
        );
        if($qwy->execute(array($psa_cod))){
            return true;
        }

        return false;
    }

    /**
     * Remove todas os ministerios amarradas ao PSA_COD informado
     * @param type $psa_cod
     */
    public static function delMinisterioPessoa($psa_cod){
        $qwy = self::$model->prepare(
            "DELETE FROM ministerio_pessoa WHERE psa_cod = ?"
        );
        if($qwy->execute(array($psa_cod))){
            return true;
        }

        return false;
    }

    public static function delCelulaPessoa($psa_cod){
        $qwy = self::$model->prepare(
            "DELETE FROM celula_pessoa WHERE psa_cod = ?"
        );
        if($qwy->execute(array($psa_cod))){
            return true;
        }

        return false;
    }
}
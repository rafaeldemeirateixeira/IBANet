<?php

class DeiaModel extends PDO
{
    /**
     * Número total de registros retornados pelo metodo selectPagination
     * @var int
     */
    public static $totalRegister = 0;

    /**
     *
     * @var type
     */
    public $pdo = null;

    public function __construct(){
        $this->pdo = $this->PDOInstance();
    }

    public static function PDOInstance(){
        try{
            $dsn = DataBaseConfig::$config["drive"] . ":dbname=" . DataBaseConfig::$config["database"] . ";host=" . DataBaseConfig::$config["host"];
            return new PDO($dsn, DataBaseConfig::$config["user"], DataBaseConfig::$config["password"], DataBaseConfig::$config["options"]);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function setLogSistema($psa_cod, $ip, $log){
        $pdo = self::PDOInstance();

        $qwy = $pdo->prepare(
            "
                INSERT INTO sistema_log(
                    psa_cod,
                    log_data,
                    log_ip,
                    log_texto
                )
                VALUES(
                    ?,TIMESTAMP(NOW()),?,?
                )
            "
        );

        if($qwy->execute(array($psa_cod, $ip, $log))){
            return true;
        }
    }

    /**
     *
     * @param object $pdo
     * @param sql $sql
     * @param array $params
     * @return array
     */
    public static function selectPagination($pdo, $sql, $params = NULL){
        try {
            DeiaController::checkString($sql);
            DeiaController::checkObject($pdo);

            $qwy = $pdo->prepare($sql);

            if($params != NULL){
                foreach ($params as $row) {
                    $qwy->bindParam($row["field"], $row["value"], $row["type"]);
                }
            }

            $qwy->execute();
            $rows = $pdo->query("SELECT FOUND_ROWS()");
            self::$totalRegister = $rows->fetchColumn();

            return $qwy->fetchAll();

        } catch (InvalidArgumentException $e) {
            echo $e->getMessage();
        }
    }
}
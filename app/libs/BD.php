<?php

/*************************************
 * clase para conectar a la base de
 * datos y ejecutar consultas con PDO
 ************************************/
class BD
{
    private $host = BD_HOST;
    private $user = BD_USER;
    private $password = BD_PASSWORD;
    private $name_base = BD_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        /********************************
         * configurar la conexion
         ********************************/
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->name_base;
        $opciones = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        /************************************
         * Crear una instancia de PDO
         ***********************************/
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $opciones);
            $this->dbh->exec('set names utf8');
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }
    /****************************************
     * se prepara la consulta
     **************************************/
    public function bing($parameter, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmt->bindValue($parameter, $value, $type);
    }
    /*******************************************
     * ejecuta la consutla
     *******************************************/
    public function execute()
    {

        return $this->stmt->execute();
    }
    /***********************
     * obtener registros
     *********************/
    public function registros()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    /****************************
     *obtner un solo registro
     ****************************/

    public function registro()
    {
        $this->execute();
        return $this->stmt->fetchA(PDO::FETCH_OBJ);
    }
    /*******************************
     * obtener la cantida de registros
     ********************************/
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}

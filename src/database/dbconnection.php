<?php
class Dbconnection
{
    private $connection;
    private $DB_HOST;
    private $DB_PORT;
    private $DB_USER;
    private $DB_PASS;
    private $DB_NAME;

    public function __construct($DB_HOST, $DB_PORT, $DB_USER, $DB_PASS, $DB_NAME)
    {
        $this->$DB_HOST = $DB_HOST;
        $this->$DB_PORT = $DB_PORT;
        $this->$DB_USER = $DB_USER;
        $this->$DB_PASS = $DB_PASS;
        $this->$DB_NAME = $DB_NAME;
        $this->connection($DB_HOST, $DB_PORT, $DB_USER, $DB_PASS, $DB_NAME);
    }
    public function connection($DB_HOST, $DB_PORT, $DB_USER, $DB_PASS, $DB_NAME)
    {
        if ($DB_PORT <> null) {
            $DB_HOST .= ":" . $DB_PORT;
        }
        try {
            $this->connection = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            //echo "Connected Successfully";
        } catch (PDOException $e) {
            echo "Connection Failed: ". $e->getMessage();
        }
        
    }
    public function getConnection(){
        return $this->connection;
    }

}
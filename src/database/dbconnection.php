<?php
class Dbconnection
{
    private $connection;
    private $DB_HOST;
    private $DB_PORT;
    private $DB_USER;
    private $DB_PASS;
    private $DB_NAME;
    private $post_value;

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
    public function insert($tbl, $data){
        ksort($data);
        
        $keys='`' . implode('`, `', array_keys($data)) . '`';
        $values= "'" . implode("', '", array_values($data)) . "'";
        $sql="INSERT INTO $tbl ($keys) VALUES ($values)";

        // die($sql);
        try{
            $this->connection->exec($sql);
            return TRUE;
        } catch(PDOException $e){
            return $sql. " <br> ".$e->getMessage();
        }
    
    }
    public function select_and($tbl, $conditions){
        
        $sql="SELECT * FROM $tbl";

        $clauses=[];

        if(!empty($conditions)){
            $sql .= " WHERE ";        
        
        foreach($conditions as $key => $value){
            $clauses[]="$key = :$key";
            
        }
        $sql .= implode(" AND ",$clauses);
        
        }

        $stmt=$this->connection->prepare($sql);
        foreach($conditions as $key => $value){
            $stmt->bindValue(":$key", $value);
        }

        //return $stmt->debugDumpParams();

        try{
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            return error_log($sql. " <br> ".$e->getMessage(),3,'errors/error.log');
        }
    }

    public function select_or($tbl, $conditions){
        
        $sql="SELECT * FROM $tbl";

        $clauses=[];

        if(!empty($conditions)){
            $sql .= " WHERE ";        
        
        foreach($conditions as $key => $value){
            $clauses[]="$key = :$key";
            
        }
        $sql .= implode(" OR ",$clauses);
        
        }

        $stmt=$this->connection->prepare($sql);
        foreach($conditions as $key => $value){
            $stmt->bindValue(":$key", $value);
        }

        //return $stmt->debugDumpParams();

        try{
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            return $sql. " <br> ".$e->getMessage();
        }
    }
    public function select_join($tbl,$joins,$where){
        $sql="SELECT * FROM $tbl";

        foreach($joins as $join){
            $sql .=" " . $join['type']. " JOIN ". $join['table']. " ON ". $join['on'];
        }

        $clauses=[];

        if(!empty($where)){
            $sql .= " WHERE ";        
        
        foreach($where as $key => $value){
            $clauses[]="$key = :$key";
            
        }
        $sql .= implode(" AND ",$clauses);
        
        }
        $stmt=$this->connection->prepare($sql);
        foreach($where as $key => $value){
            $stmt->bindValue(":$key", $value);
        }

        //return $stmt->debugDumpParams();

        try{
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            return $sql. " <br> ".$e->getMessage();
        }
    }

    public function escape_values($post_value){
        $this->post_value = addslashes($post_value);
        return $this->post_value;
    }
    
    
    public function getLastInsertId(){
        return $this->connection->lastInsertId(); 
    }

    public function update($tbl, $data, $where){
        $sql="UPDATE $tbl SET ";
        $clauses=[];
        foreach($data as $key=>$value){
            $clauses[]="$key = :$key";
        }
        $sql .=implode(' , ', $clauses);

        $sql .=" WHERE $where";

        
        $stmt=$this->connection->prepare($sql);
        //return $stmt->debugDumpParams();

        foreach($data as $key => $value){
            $stmt->bindValue(":$key",$value);
        }

        try{
            $stmt->execute();
            return TRUE;
            
        }catch(PDOException $e){
            return $sql. " <br> ".$e->getMessage();
        }



    }

    public function deleteRecord($tbl,$where){
        $sql="DELETE FROM $tbl";

        $clauses=[];

        if(!empty($where)){
            $sql .= " WHERE ";        
        
        foreach($where as $key => $value){
            $clauses[]="$key = :$key";
            
        }
        $sql .= implode(" OR ",$clauses);
        
        }

        $stmt=$this->connection->prepare($sql);
        foreach($where as $key => $value){
            $stmt->bindValue(":$key", $value);
        }

        //return $stmt->debugDumpParams();

        try{
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        }catch(PDOException $e){
            return $sql. " <br> ".$e->getMessage();
        }
    }
}
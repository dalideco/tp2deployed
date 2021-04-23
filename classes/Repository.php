<?php
include_once 'autoload.php';

class Repository
{
    protected $bd;
    protected $tableName;
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->bd = ConnexionBD::getInstance();
    }

    
    public function findByEmail($mail)
    {
        $request = "select * from ".$this->tableName ." where mail = ?";
        $response =$this->bd->prepare($request);
        $response->execute([$mail]);
        return $response->fetch(PDO::FETCH_OBJ);
    }

    
} 
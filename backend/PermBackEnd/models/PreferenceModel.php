<?php

class PreferenceModel
{
//DB stuff
    private $conn;
    private $table = 'preferences';

    //Properties
    public $id;
    public $user_id;
    public $preference;

    //Constructor with DB

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Orders
    public function read()
    {
        //Create query
        $query = 'SELECT 
                *
                FROM
                ' . $this->table . ' 
                ORDER BY id ASC
                ';
        //Prepare statement
        $stmt = $this->conn->prepare($query);
        //Execute query
        $stmt->execute();
        return $stmt;
    }

    //Get single order
    public function read_single($paramId)
    {
        $query = 'SELECT 
                *
                FROM
                ' . $this->table . ' 
                WHERE user_id=:paramId
                ';
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindParam(':paramId', $paramId);
        //Execute query
        $stmt->execute();
        return $stmt;
    }
}
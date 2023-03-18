<?php

class OrderModel
{
    //DB stuff
    private $conn;
    private $table = 'orders';

    //Properties
    public $id;
    public $user_id;
    public $phone;
    public $zip_code;
    public $address_line;
    public $country;
    public $city;
    public $price;
    public $date_completed;
    public $payment_method;

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
    public function read_single()
    {
        //Create query
        $query = 'SELECT 
                *
                FROM
                ' . $this->table . ' 
                WHERE user_id=:id
                ';
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindParam(':id', $this->user_id);
        //Execute query
        $stmt->execute();

        return $stmt;
    }

  

    public function read_id_single()
    {
        //Create query
        $query = 'SELECT 
                *
                FROM
                ' . $this->table . ' 
                WHERE id=:id
                ';
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindParam(':id', $this->id);
        //Execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //set properties
        $this->user_id = $row['user_id'];
        $this->phone = $row['phone'];
        $this->zip_code = $row['zip_code'];
        $this->address_line = $row['address_line'];
        $this->country = $row['country'];
        $this->city = $row['city'];
        $this->price = $row['price'];
        $this->date_completed = $row['date_completed'];
        $this->payment_method = $row['payment_method'];
    }
}
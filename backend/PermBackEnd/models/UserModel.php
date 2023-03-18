<?php

class UserModel
{
    //DB stuff
    private $conn;
    private $table = 'users';

    //Properties
    public $id;
    public $first_name;
    public $last_name;
    public $gender;
    public $mail;
    public $user_password;
    public $is_admin;

    //Constructor with DB

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Users
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

    //Get single user
    public function read_single()
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
        $this->first_name = $row['first_name'];
        $this->last_name = $row['last_name'];
        $this->gender = $row['gender'];
        $this->mail = $row['mail'];
        $this->user_password = $row['user_password'];
        $this->is_admin = $row['is_admin'];
    }


    //Create User
    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . '
        SET
            first_name = :first_name,
            last_name = :last_name,
            gender = :gender,
            mail = :mail,
            user_password = :user_password
        ';
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->mail = htmlspecialchars(strip_tags($this->mail));
        $this->user_password = htmlspecialchars(strip_tags($this->user_password));
        $this->is_admin = htmlspecialchars(strip_tags($this->is_admin));

        //Bind data
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':user_password', $this->user_password);
        $stmt->bindParam(':is_admin', $this->is_admin);

        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // UPDATE USER
    public function update()
    {
        $query = 'UPDATE ' . $this->table . '
        SET 
          first_name = :first_name,
          last_name = :last_name,
          gender = :gender,
          mail = :mail,
          user_password = :user_password
          WHERE id=:id';

        // PREPARE
        $stmt = $this->conn->prepare($query);
        // CLEAN DATA
        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->mail = htmlspecialchars(strip_tags($this->mail));
        $this->user_password = htmlspecialchars(strip_tags($this->user_password));
        $this->id = htmlspecialchars(strip_tags($this->id));


        // BIND DATA

        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':user_password', $this->user_password);
        $stmt->bindParam(':id', $this->id);

        // EXECUTE

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }


    //   DELETE PRODUCT

    public function delete()
    {

        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        // PREPARE
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
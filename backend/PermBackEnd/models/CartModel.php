<?php

class CartModel
{
    //DB stuff
    private $conn;
    private $table = 'cart';

    //Properties
    public $id;
    public $product_id;
    public $user_id;
    public $quantity;

    //Constructor with DB

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //Get Carts
    public function read($paramId)
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

    public function create()
    {
        $query1 = 'SELECT
                *
                FROM
                ' . $this->table . '
                WHERE user_id=:user_id AND
                product_id = :product_id
                AND quantity = :quantity
                ';

        $stmt = $this->conn->prepare($query1);
        //Clean data
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));

        //Bind data
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':quantity', $this->quantity);

        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false;
        }


        $query = 'INSERT INTO ' . $this->table . '
        SET
            product_id = :product_id,
            user_id = :user_id,
            quantity = :quantity
        ';

        $stmt = $this->conn->prepare($query);
        //Clean data
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));

        //Bind data
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':quantity', $this->quantity);


        //Execute query
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function delete($user_id, $product_id)
    {
        $query1 = 'SELECT
                *
                FROM
                ' . $this->table . '
                WHERE user_id=:user_id AND
                product_id = :product_id

                ';

        $stmt = $this->conn->prepare($query1);
        //Clean data
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));


        //Bind data
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':user_id', $user_id);


        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            return false;
        }

        $query = 'DELETE FROM ' . $this->table . ' WHERE user_id =:user_id AND product_id = :product_id';
        // PREPARE
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        // Bind data
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':product_id', $product_id);
        // Execute query

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                printf("No entry for product");
            }
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // UPDATE USER
    public function update()
    {
        $query = 'UPDATE ' . $this->table . '
        SET 
          quantity = :quantity
          WHERE id=:id';

        // PREPARE
        $stmt = $this->conn->prepare($query);
        // CLEAN DATA
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));

        // BIND DATA

        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':id', $this->id);

        // EXECUTE

        if ($stmt->execute()) {
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

}


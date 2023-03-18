<?php

class CommentModel
{
//DB stuff
    private $conn;
    private $table = 'comments';

    //Properties
    public $id;
    public $product_id;
    public $user_id;
    public $comment;
    public $rating;

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
                WHERE product_id=:paramId
                ';
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindParam(':paramId', $paramId);
        //Execute query
        $stmt->execute();
        return $stmt;
    }

    public function readComment($productId, $userId)
    {
        $query = 'SELECT 
                *
                FROM
                ' . $this->table . ' 
                WHERE product_id =:productId AND user_id =:userId
                ';
        //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Bind data
        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':userId', $userId);
        //Execute query
        $stmt->execute();
        return $stmt;
    }

    public function readUserDetails($commentId)
    {
        $stmt2 = $this->conn->prepare('SELECT user_id FROM comments WHERE id =:comment_id');
        $stmt2->bindParam(':comment_id', $commentId);
        $stmt2->execute();
        $user_id = $stmt2->fetch();

        $query = 'SELECT first_name, last_name from users WHERE id =:user_id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id[0]);
        $stmt->execute();
        return $stmt;
    }

}
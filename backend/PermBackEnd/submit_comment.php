<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /../PerM/frontend/login.html");
    exit;
}
include("config/Database.php");
if (isset($_POST['comment'])) {
    $productId = $_POST['product_id'];
    $userId = $_SESSION['user_id'];
    $rating = $_POST['rate'];
    $comment = $_POST['commentText'];

    $database = new Database();
    $db = $database->connect();

    $stmt = $db->prepare('INSERT INTO comments
                                SET
                                product_id =:product_id,
                                user_id =:user_id,
                                comment =:comment,
                                rating =:rating');
    $stmt->bindParam(':product_id', $productId);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':rating', $rating);
    try {
        if ($stmt->execute()) {
            header("location:/../PerM/frontend/after_comment.html");
        }
    } catch (PDOException) {
        header("location:/../PerM/frontend/after_comment_error.html");
    }

}
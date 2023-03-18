<?php
include("config/Database.php");
if (isset($_POST['submit_new_password'])) {

    $email = $_POST['email'];
    $pass = $_POST['new_password'];

    $database = new Database();
    $db = $database->connect();
    $query = 'UPDATE users
        SET
          user_password = :user_password
          WHERE md5(mail)=:email';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $password_hash = password_hash($pass, PASSWORD_BCRYPT);
    $stmt->bindParam(':user_password', $password_hash);
    $stmt->execute();
    header("location: /../PerM/frontend/login.html");
}

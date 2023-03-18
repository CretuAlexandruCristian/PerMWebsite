<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'C:\Users\stefa\vendor\autoload.php';

include("config/Database.php");

if (isset($_POST['submit_email'])) {
    $database = new Database();
    $db = $database->connect();

    $query = 'SELECT 
                *
                FROM
                users
                WHERE mail=:email
                ';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $email = md5($row['mail']);
    $pass = md5($row['user_password']);


    $link = "<a href='http://localhost/PerM/backend/PermBackEnd/reset_pass.php?key=" . $email . "&reset=" . $pass . "'>Click To Reset password</a>";

    $mail = new PHPMailer();
    $mail->CharSet = "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;
    // GMAIL username
    $mail->Username = "stefaneldragoi1329@gmail.com";
    // GMAIL password
    $mail->Password = "khkaxpabzqwaijcq";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From = 'stefaneldragoi1329@gmail.com';
    $mail->FromName = 'PerM Reset Password';    
    try {
        $mail->AddAddress($_POST['email']);
    } catch (Exception $e) {
    }
    $mail->Subject = 'Reset Password';
    $mail->IsHTML(true);
    $mail->Body = 'Click On This Link to Reset Password -> ' . $link . '';
    if ($mail->Send()) {
        echo "Check Your Email and Click on the link sent to your email";
    } else {
        echo "Mail Error - >" . $mail->ErrorInfo;
    }

}







<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION['is_admin']==null) {
    header("location: /../PerM/frontend/index.html");
    exit;
}

include("config/Database.php");


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $database = new Database();
    $db = $database->connect();

    $query = $db->prepare("SELECT * FROM users WHERE mail=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo '<p class="error">Username password combination is wrong!</p>';
    } else {
        if (password_verify($password, $result['user_password'])) {
            echo '<p>logged in </p>';
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION['user_id'] = $result['id'];
            $_SESSION["email"] = $result['mail'];
            $_SESSION['firstName'] = $result['first_name'];
            $_SESSION['lastName'] = $result['last_name'];
            $_SESSION['gender'] = $result['gender'];
            $_SESSION['password'] = $result['user_password'];
            $_SESSION['is_admin'] = $result['is_admin'];
            if ($result['is_admin']) {
                header("location: /../PerM/backend/PermBackEnd/admin.php");
            } else
                header("location: /../PerM/frontend/index.php");
        } else {
            echo "You have entered an invalid username or password";

        }
    }

}
?>

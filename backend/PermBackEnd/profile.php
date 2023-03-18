<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /../PerM/frontend/login.html");
    exit;
}
$confirmPasswordError = "";
include("config/Database.php");

if (isset($_POST['reset'])) {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];


    if (password_verify($oldPassword, $_SESSION['password'])) {
        $database = new Database();
        $db = $database->connect();

        $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
        $confirmPasswordHash = password_hash($confirmPassword, PASSWORD_BCRYPT);
        if ($newPassword != $confirmPassword) {
            $confirmPasswordError = "Password did not match.";
        }
        $stmt = $db->prepare("UPDATE users SET user_password = :password WHERE id = :id");
        $stmt->bindParam("password", $newPasswordHash, PDO::PARAM_STR);
        $stmt->bindParam("id", $_SESSION['user_id'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            session_destroy();
            header("location: /../PerM/frontend/login.html");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        $db->query('KILL CONNECTION_ID()');
        $db = null;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <link rel="shortcut icon" type="image/x-icon" href="/../PerM/frontend/favicon.ico"/>
    <link rel="stylesheet" href="/../PerM/frontend/css/style.css"/>
    <link rel="stylesheet" href="/../PerM/frontend/css/utilities.css"/>
    <title>PerM | Profile</title>
</head>
<body id="profile-page">
<div class="image-profile">
    <a href="/../PerM/frontend/index.php" title="Go to HomePage"><img
                src="/../PerM/frontend/images/logo-render.png"></a>
</div>

<div class="profile-container">
    <h1><?php
        echo 'Hello, ' . $_SESSION["firstName"] . ' ' . $_SESSION["lastName"];
        ?></h1>

    <div class="slide" id="column">

        <form action="./updateUser.php" method="post">
            <h3>Account Settings</h3>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>"/>
            </div>
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" name="firstName" id="first-name" value="<?php echo $_SESSION['firstName']; ?>"/>
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" name="lastName" id="last-name" value="<?php echo $_SESSION['lastName']; ?>"/>
            </div>
        </form>
        <div class="slide-order">
            <h3>My Orders</h3>
            
                <ul id="orders">
                <!-- <li><a href="">Order no. 123123123</a></li> -->
                
                </ul>
            

        </div>
    </div>
    <div class="slide" id="final">
        <h3>Reset Password</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="password">Old password</label>
                <input type="password" name="old_password" id="old_password"/>
            </div>
            <div class="form-group">
                <label for="password">New password</label>
                <input type="password" name="new_password" id="new_password"/>
            </div>
            <div class="form-group">
                <label for="password">Confirm new password</label>
                <input type="password" name="confirm_password" id="confirm_password"/>
                <span><?php echo $confirmPasswordError ?></span>
            </div>
            <button type="submit" name="reset" class="btn">Update</button>
        </form>
    </div>
</div>

<!-- <script src="/../PerM/frontend/app.js"></script> -->
<script>
    var id=<?php echo $_SESSION["user_id"]?>;
    console.log(id);
    var URL='http://localhost/PerM/backend/PermBackEnd/index.php/order/listSingle/'+id;

    fetch(URL)

    .then((res) =>res.json())
    .then((data) => {
        let output='';
        console.log(data);
        data.forEach(function(order){
            var order_id=order.id;
        output+='<li><a href="http://localhost/PerM/frontend/order.html?id='+order_id+'">Order ' + order_id + '</a></li>';
        
        });
        document.getElementById("orders").innerHTML=output;
    })


</script>
</body>
</html>
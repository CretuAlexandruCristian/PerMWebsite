<?php
if ($_GET['key'] && $_GET['reset']) {
    $email = $_GET['key'];
    $pass = $_GET['reset'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" type="image/x-icon" href="/../PerM/frontend/favicon.ico"/>
    <link rel="stylesheet" href="/../PerM/frontend/css/style.css"/>
    <link rel="stylesheet" href="/../PerM/frontend/css/utilities.css"/>
    <title>PerM | Reset Password</title>
</head>

<body id="login-form">
<div class="image-profile">
    <a href="/../PerM/frontend/index.php" title="Go to HomePage"><img
                src="/../PerM/frontend/images/logo-render.png"></a>
</div>

<div class="container-login">
    <div class="form-wrap">
        <h1>New Password</h1>
        <br/>
        <p>Submit your new password.</p>
        <form action="submit_new.php" method="post">
            <div class="form-group">
                <label for="password">New password</label>
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="password" name="new_password" id="new_password"/>
            </div>
            <button type="submit" name="submit_new_password" class="btn">Submit</button>
        </form>

    </div>
</div>
<footer class="footer-login">
    <ul>
        <li><a href="#">Account&nbsp;Information </a></li>
        <li><a href="#">Terms&nbsp;&&nbsp;Conditions</a></li>
        <li><a href="#">Privacy&nbsp;Policy</a></li>
        <li>
            <a href="#" class="last">We&nbsp;Are&nbsp;Using&nbsp;Cookies</a>
        </li>
    </ul>
</footer>
</body>
</html>

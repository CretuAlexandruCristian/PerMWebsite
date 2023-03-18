<?php
include("config/Database.php");
if (isset($_POST['register'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $database = new Database();
    $db = $database->connect();

    $query = $db->prepare("SELECT * FROM users WHERE mail=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
        echo '<p class="error">The email address is already registered!</p>';
    }
    if ($query->rowCount() == 0) {
        $query = $db->prepare("INSERT INTO users(first_name,last_name,gender,mail,user_password)
                                    VALUES (:firstName,:lastName,:gender,:email,:password_hash)");
        $query->bindParam("firstName", $firstName, PDO::PARAM_STR);
        $query->bindParam("lastName", $lastName, PDO::PARAM_STR);
        $query->bindParam("gender", $gender, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $result = $query->execute();

        if (isset($_POST['preference1'])) {
            $stmt1 = $db->prepare("SELECT id FROM users order by id DESC LIMIT 1");
            $stmt1->execute();
            $userId = $stmt1->fetch()[0];

            $stmt = $db->prepare("INSERT INTO preferences(user_id, preference) VALUES(:user_id,:preference)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':preference', $_POST['preference1']);
            $stmt->execute();
        }
        if (isset($_POST['preference2'])) {
            $stmt1 = $db->prepare("SELECT id FROM users order by id DESC LIMIT 1");
            $stmt1->execute();
            $userId = $stmt1->fetch()[0];

            $stmt = $db->prepare("INSERT INTO preferences(user_id, preference) VALUES(:user_id,:preference)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':preference', $_POST['preference2']);
            $stmt->execute();
        }
        if (isset($_POST['preference3'])) {
            $stmt1 = $db->prepare("SELECT id FROM users order by id DESC LIMIT 1");
            $stmt1->execute();
            $userId = $stmt1->fetch()[0];

            $stmt = $db->prepare("INSERT INTO preferences(user_id, preference) VALUES(:user_id,:preference)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':preference', $_POST['preference3']);
            $stmt->execute();
        }
        if (isset($_POST['preference4'])) {
            $stmt1 = $db->prepare("SELECT id FROM users order by id DESC LIMIT 1");
            $stmt1->execute();
            $userId = $stmt1->fetch()[0];

            $stmt = $db->prepare("INSERT INTO preferences(user_id, preference) VALUES(:user_id,:preference)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':preference', $_POST['preference4']);
            $stmt->execute();
        }
        if (isset($_POST['preference5'])) {
            $stmt1 = $db->prepare("SELECT id FROM users order by id DESC LIMIT 1");
            $stmt1->execute();
            $userId = $stmt1->fetch()[0];

            $stmt = $db->prepare("INSERT INTO preferences(user_id, preference) VALUES(:user_id,:preference)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':preference', $_POST['preference5']);
            $stmt->execute();
        }
        if (isset($_POST['preference6'])) {
            $stmt1 = $db->prepare("SELECT id FROM users order by id DESC LIMIT 1");
            $stmt1->execute();
            $userId = $stmt1->fetch()[0];

            $stmt = $db->prepare("INSERT INTO preferences(user_id, preference) VALUES(:user_id,:preference)");
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':preference', $_POST['preference6']);
            $stmt->execute();
        }

        if ($result) {
            echo '<p class="success">Your registration was successful!</p>
                   <a href="/PerM/frontend/index.php">click here to go home</a>';
        } else {
            echo '<p class="error">Something went wrong!</p>';
        }
    }
}
?>
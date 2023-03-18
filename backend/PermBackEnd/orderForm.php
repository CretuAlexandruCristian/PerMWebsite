<?php

session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /../PerM/frontend/login.html");
    exit;
}
include("config/Database.php");
if (isset($_POST['order_form'])) {

    $address_line = $_POST['address_line'];
    $zip_code = $_POST['zip_code'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $payment_method = $_POST['payment_method'];
    $price = $_POST['price'];

    $database = new Database();
    $db = $database->connect();

    $date_completed = date("Y-m-d");

    $stmt = $db->prepare("INSERT INTO orders SET  user_id = :id,
                                                        phone = :phone,
                                                        zip_code = :zip_code,
                                                        address_line = :address_line,
                                                        country = :country,
                                                        city = :city,
                                                        price = :price,
                                                        date_completed = :date_completed,
                                                        payment_method = :payment_method");
    $stmt->bindParam("id", $_SESSION['user_id'], PDO::PARAM_STR);
    $stmt->bindParam("phone", $phone, PDO::PARAM_STR);
    $stmt->bindParam("zip_code", $zip_code, PDO::PARAM_STR);
    $stmt->bindParam("address_line", $address_line, PDO::PARAM_STR);
    $stmt->bindParam("country", $country, PDO::PARAM_STR);
    $stmt->bindParam("city", $city, PDO::PARAM_STR);
    $stmt->bindParam("price", $price, PDO::PARAM_STR);
    $stmt->bindParam("date_completed", $date_completed, PDO::PARAM_STR);
    $stmt->bindParam("payment_method", $payment_method, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $stmt2 = $db->prepare("SELECT id FROM orders ORDER BY id DESC LIMIT 1");
        $stmt2->execute();
        $order_id = $stmt2->fetch();

        $stmtCart = $db->prepare("SELECT product_id, quantity FROM cart WHERE user_id = :user_id");
        $stmtCart->bindParam('user_id', $_SESSION['user_id']);
        $stmtCart->execute();
        while ($row = $stmtCart->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $post_item = array(
                'product_id' => $product_id,
                'quantity' => $quantity
            );
            $stmtOrderToProduct = $db->prepare("INSERT INTO order_to_product SET order_id = :order_id,
                                                                                       product_id = :product_id,
                                                                                       quantity = :quantity");
            $stmtOrderToProduct->bindParam('order_id', $order_id[0]);
            $stmtOrderToProduct->bindParam('product_id', $post_item['product_id']);
            $stmtOrderToProduct->bindParam('quantity', $post_item['quantity']);
            if ($stmtOrderToProduct->execute()) {
                $stmtDeleteCart = $db->prepare("DELETE FROM cart WHERE user_id = :user_id");
                $stmtDeleteCart->bindParam('user_id', $_SESSION['user_id']);
                $stmtDeleteCart->execute();

                $stmtUpdateQuantity = $db->prepare("UPDATE products SET stock = :new_stock, sold  =:new_sold WHERE id = :product_id");

                $stmtGetStock = $db->prepare("SELECT stock, sold FROM products WHERE id=:id");
                $stmtGetStock->bindParam('id', $post_item['product_id']);
                $stmtGetStock->execute();

                $currentStock = $stmtGetStock->fetch();
                $new_stock = $currentStock[0] - $post_item['quantity'];
                $new_sold = $currentStock[1] + $post_item['quantity'];

                $stmtUpdateQuantity->bindParam('new_stock', $new_stock);
                $stmtUpdateQuantity->bindParam('new_sold', $new_sold);
                $stmtUpdateQuantity->bindParam('product_id', $post_item['product_id']);
                $stmtUpdateQuantity->execute();
                $location = "location: /../PerM/frontend/order.html?id=" . $order_id[0];

                header($location);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="/../PerM/frontend/css/style.css">
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


    <div class="userDetails container">


        <div class="row_form">
            <div class="col-25">
                <label for="address_line">Address Line</label>
            </div>
            <div class="col-75">
                <input type="text" id="address_line" name="address_line">
            </div>
        </div>


        <div class="row_form">
            <div class="col-25">
                <label for="zip_code">ZIP(or postal) code</label>
            </div>
            <div class="col-75">
                <input type="text" id="zip_code" name="zip_code">
            </div>
        </div>

        <div class="row_form">
            <div class="col-25">
                <label for="country">Country</label>
            </div>
            <div class="col-75">
                <input type="text" id="country" name="country">
            </div>
        </div>
        <div class="row_form">
            <div class="col-25">
                <label for="city">City</label>
            </div>
            <div class="col-75">
                <input type="text" id="city" name="city">
            </div>
        </div>

        <div class="row_form">
            <div class="col-25">
                <label for="phone">Phone number</label>
            </div>
            <div class="col-75">
                <input type="text" id="phone" name="phone">
            </div>
        </div>

        <div class="row_form">
            <div class="col-25">
                <label for="payment_method">Payment Method</label>
            </div>
            <div class="col-75">
                <select name="payment_method" id="payment_method">
                    <option value="" disabled selected>Please select</option>
                    <option value="cash">Cash</option>
                    <option value="online">Online</option>
                </select>
            </div>
        </div>
        <div id="invisible"></div>
        <div class="row_form">
            <input type="submit" name="order_form" value="Submit">
        </div>

    </div>


</form>

<script>
    // <input type="hidden" name="price" value="">
    url = window.location.search;
    const urlParams = new URLSearchParams(url);
    const total = urlParams.get("total");
    document.getElementById('invisible').innerHTML = '<input type="hidden" name="price" value="' + total + '">'
    console.log(total);

</script>
</body>
</html>
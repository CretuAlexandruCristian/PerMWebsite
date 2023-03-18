<?php

header('Access-Control-Allow-Origin: *');

require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ((isset($uri[5]) && ($uri[5] != 'product') && ($uri[5] != 'user') && ($uri[5] != 'cart') && ($uri[5] != 'order')
        && ($uri[5] != 'orderToProduct') && ($uri[5] != 'comment') && ($uri[5] != 'preference')) || !isset($uri[4])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

require PROJECT_ROOT_PATH . "api/UserController.php";
require PROJECT_ROOT_PATH . "api/ProductController.php";
require PROJECT_ROOT_PATH . "api/CartController.php";
require PROJECT_ROOT_PATH . "api/OrderController.php";
require PROJECT_ROOT_PATH . "api/OrderToProductController.php";
require PROJECT_ROOT_PATH . "api/CommentController.php";
require PROJECT_ROOT_PATH . "api/PreferenceController.php";

if ($uri[5] == 'user') {
    $objFeedController = new UserController();
} else if ($uri[5] == 'product') {
    $objFeedController = new ProductController();
} else if ($uri[5] == 'cart') {
    $objFeedController = new CartController();
} else if ($uri[5] == 'order') {
    $objFeedController = new OrderController();
} else if ($uri[5] == 'orderToProduct') {
    $objFeedController = new OrderToProductController();
} else if ($uri[5] == 'comment') {
    $objFeedController = new CommentController();
} else if ($uri[5] == 'preference') {
    $objFeedController = new PreferenceController();
}

$strMethodName = $uri[6] . 'Action';
if (isset($uri[7]) && isset($uri[8])) {
    $objFeedController->{$strMethodName}($uri[7], $uri[8]);
} else if (isset($uri[7])) {
    $objFeedController->{$strMethodName}($uri[7]);
} else
    $objFeedController->{$strMethodName}();
?>
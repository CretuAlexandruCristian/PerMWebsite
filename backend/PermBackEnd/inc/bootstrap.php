<?php
const PROJECT_ROOT_PATH = __DIR__ . "/../";
// include the base controller file
require_once PROJECT_ROOT_PATH . "/api/BaseController.php";

// include the use model file
require_once PROJECT_ROOT_PATH . "/models/UserModel.php";
require_once PROJECT_ROOT_PATH . "/models/ProductModel.php";
require_once PROJECT_ROOT_PATH . "/models/CartModel.php";
require_once PROJECT_ROOT_PATH . "/models/OrderModel.php";
require_once PROJECT_ROOT_PATH . "/models/OrderToProductModel.php";
require_once PROJECT_ROOT_PATH . "/models/CommentModel.php";
require_once PROJECT_ROOT_PATH . "/models/PreferenceModel.php";
?>
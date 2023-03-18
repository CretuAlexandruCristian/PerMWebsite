<?php


class CartController extends BaseController
{
    /**
     * Endpoint for user cart /index.php/cart/{user_id}
     *
     */
    public function listAction($paramId)
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $cartModel = new CartModel($db);
                $rows = array();

                $result = $cartModel->read($paramId);
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);

                    $post_item = array(
                        'id' => $id,
                        'product_id' => $product_id,
                        'user_id' => $user_id,
                        'quantity' => $quantity
                    );
                    //Turn to JSON
                    $rows[] = $post_item;
                }
                $responseData = json_encode($rows);

            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    public function createAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $database = new Database();
                $db = $database->connect();
                //Instantiate blog post object
                $cart = new CartModel($db);

                //Get raw posted data
                $data = json_decode(file_get_contents("php://input"));

                $cart->product_id = $data->product_id;
                $cart->user_id = $data->user_id;
                $cart->quantity = $data->quantity;

                //Create post
                if ($cart->create()) {
                    echo json_encode(
                        array('message' => 'CartModel Created')
                    );
                } else {
                    echo json_encode(
                        array('message' => 'CartModel Not Created')
                    );
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
    }

    public function deleteAction($user_id, $product_id)
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'DELETE') {
            try {
                $database = new Database();
                $db = $database->connect();
                //Instantiate blog post object
                $cartModel = new CartModel($db);

                //Get raw posted data
                $data = json_decode(file_get_contents("php://input"));

                //Create post
                if ($cartModel->delete($user_id, $product_id)) {
                    echo json_encode(
                        array('message' => 'Product with ID ' . $product_id . ' Deleted From User Id->' . $user_id)
                    );
                } else {
                    echo json_encode(
                        array('message' => 'Product with ID ' . $product_id . ' From User Id->' . $user_id . ' Not Deleted')
                    );
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
    }

    public function updateAction($cartId, $quantity)
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'PUT') {
            try {
                $database = new Database();
                $db = $database->connect();
                //Instantiate blog post object
                $cart = new CartModel($db);

                $cart->id = $cartId;
                $cart->quantity = $quantity;

                //Create post
                if ($cart->update()) {
                    echo json_encode(
                        array('message' => 'CartModel updated quantity ' . $quantity . ' Updated')
                    );
                } else {
                    echo json_encode(
                        array('message' => 'CartModel with ID ' . $quantity . ' Not Updated')
                    );
                }
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
    }
}
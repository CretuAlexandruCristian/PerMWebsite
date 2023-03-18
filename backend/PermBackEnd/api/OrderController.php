<?php

class OrderController extends BaseController
{
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $orderModel = new OrderModel($db);
                $rows = array();
                //Blog post query
                $result = $orderModel->read();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);

                    $post_item = array(
                        'id' => $id,
                        'user_id' => $user_id,
                        'phone' => $phone,
                        'zip_code' => $zip_code,
                        'address_line' => $address_line,
                        'country' => $country,
                        'city' => $city,
                        'price' => $price,
                        'date_completed' => $date_completed,
                        'payment_method' => $payment_method
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

    public function listSingleAction($paramId)
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $orderModel = new OrderModel($db);
                $orderModel->user_id = $paramId;
                // Get post
                $result = $orderModel->read_single();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);

                    $post_item = array(
                        'id' => $id,
                        'user_id' => $user_id,
                        'phone' => $phone,
                        'zip_code' => $zip_code,
                        'address_line' => $address_line,
                        'country' => $country,
                        'city' => $city,
                        'price' => $price,
                        'date_completed' => $date_completed,
                        'payment_method' => $payment_method
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

    public function listSingleIdAction($paramId)
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $orderModel = new OrderModel($db);
                $orderModel->id = $paramId;
                // Get post
                $orderModel->read_id_single();
                $post_item = array(
                    'id' => $orderModel->id,
                    'user_id' => $orderModel->user_id,
                    'phone' => $orderModel->phone,
                    'zip_code' => $orderModel->zip_code,
                    'address_line' => $orderModel->address_line,
                    'country' => $orderModel->country,
                    'city' => $orderModel->city,
                    'price' => $orderModel->price,
                    'date_completed' => $orderModel->date_completed,
                    'payment_method' => $orderModel->payment_method
                );

                $responseData = json_encode($post_item);

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

   

}
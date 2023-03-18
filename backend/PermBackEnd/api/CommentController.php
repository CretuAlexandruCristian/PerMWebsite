<?php

class CommentController extends BaseController
{
    public function listAction($productId)
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $commentModel = new CommentModel($db);
                $rows = array();

                $result = $commentModel->read($productId);
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);

                    $post_item = array(
                        'id' => $id,
                        'product_id' => $product_id,
                        'user_id' => $user_id,
                        'comment' => $comment,
                        'rating' => $rating
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

    public function listSingleAction($productId, $userId)
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $commentModel = new CommentModel($db);

                $result = $commentModel->readComment($productId, $userId);
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $post_item = array(
                    'id' => $row['id'],
                    'product_id' => $row['product_id'],
                    'user_id' => $row['user_id'],
                    'comment' => $row['comment'],
                    'rating' => $row['rating']
                );
                //Turn to JSON


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

    public function listUserAction($commentId)
    {
        {
            $strErrorDesc = '';
            $requestMethod = $_SERVER["REQUEST_METHOD"];

            if (strtoupper($requestMethod) == 'GET') {
                try {
                    $database = new Database();
                    $db = $database->connect();
                    $commentModel = new CommentModel($db);

                    $result = $commentModel->readUserDetails($commentId);
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    $post_item = array(
                        'first_name' => $row['first_name'],
                        'last_name' => $row['last_name'],
                    );
                    //Turn to JSON


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
}
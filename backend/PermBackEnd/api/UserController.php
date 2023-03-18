<?php
//require PROJECT_ROOT_PATH . "config/Database.php";

class UserController extends BaseController
{

    /**
     * "/user/list" Endpoint - Get list of users
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $userModel = new UserModel($db);
                $rows = array();
                //Blog post query
                $result = $userModel->read();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);

                    $post_item = array(
                        'id' => $id,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'gender' => $gender,
                        'mail' => $mail,
                        'user_password' => $user_password,
                        'is_admin' => $is_admin
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
                $userModel = new UserModel($db);
                $userModel->id = $paramId;
                // Get post
                $userModel->read_single();
                $post_item = array(
                    'id' => $userModel->id,
                    'first_name' => $userModel->first_name,
                    'last_name' => $userModel->last_name,
                    'gender' => $userModel->gender,
                    'mail' => $userModel->mail,
                    'user_password' => $userModel->user_password,
                    'is_admin' => $userModel->is_admin
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


    public function createAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'POST') {
            try {
                $database = new Database();
                $db = $database->connect();
                //Instantiate blog post object
                $post = new UserModel($db);

                //Get raw posted data
                $data = json_decode(file_get_contents("php://input"));

                $post->first_name = $data->first_name;
                $post->last_name = $data->last_name;
                $post->gender = $data->gender;
                $post->mail = $data->mail;
                $post->user_password = $data->user_password;

                //Create post
                if ($post->create()) {
                    echo json_encode(
                        array('message' => 'UserModel Created')
                    );
                } else {
                    echo json_encode(
                        array('message' => 'UserModel Not Created')
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


    public function updateAction($paramId)
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'PUT') {
            try {
                $database = new Database();
                $db = $database->connect();
                //Instantiate blog post object
                $user = new UserModel($db);

                //Get raw posted data
                $data = json_decode(file_get_contents("php://input"));

                $user->id = $paramId;
                $user->first_name = $data->first_name;
                $user->last_name = $data->last_name;
                $user->gender = $data->gender;
                $user->mail = $data->mail;
                $user->user_password = $data->user_password;

                //Create post
                if ($user->update()) {
                    echo json_encode(
                        array('message' => 'UserModel with ID ' . $paramId . ' Updated')
                    );
                } else {
                    echo json_encode(
                        array('message' => 'UserModel with ID ' . $paramId . ' Not Updated')
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

    public function deleteAction($paramId)
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'DELETE') {
            try {
                $database = new Database();
                $db = $database->connect();
                //Instantiate blog post object
                $user = new UserModel($db);

                //Get raw posted data
                $data = json_decode(file_get_contents("php://input"));

                $user->id = $paramId;


                //Create post
                if ($user->delete()) {
                    echo json_encode(
                        array('message' => 'UserModel with ID ' . $paramId . ' Deleted')
                    );
                } else {
                    echo json_encode(
                        array('message' => 'UserModel with ID ' . $paramId . ' Not Deleted')
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
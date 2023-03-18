<?php
require PROJECT_ROOT_PATH . "config/Database.php";

class ProductController extends BaseController
{
    /**
     * Endpoint for products /index.php/product/list
     * @return void
     */
    public function listAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $productModel = new ProductModel($db);
                $rows = array();

                $result = $productModel->read();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $post_item = array(
                        'id' => $id,
                        'brand' => $brand,
                        'gender' => $gender,
                        'perfume_name' => $perfume_name,
                        'stock' => $stock,
                        'price' => $price,
                        'top_notes' => $top_notes,
                        'base_notes' => $base_notes,
                        'heart_notes' => $heart_notes,
                        'launch_year' => $launch_year,
                        'description' => $description,
                        'perfume_type' => $perfume_type,
                        'family' => $family,
                        'subfamily' => $subfamily,
                        'ingredients' => $ingredients,
                        'occasion' => $occasion,
                        'sold' => $sold,
                        'season' => $season,
                        'capacity' => $capacity,
                        'image_name' => $image_name,
                        'image_name2' => $image_name2,
                        'image_name3' => $image_name3
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

    public function listBestSellingsAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $productModel = new ProductModel($db);
                $rows = array();

                $result = $productModel->readBestSellings();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $post_item = array(
                        'id' => $id,
                        'brand' => $brand,
                        'gender' => $gender,
                        'perfume_name' => $perfume_name,
                        'stock' => $stock,
                        'price' => $price,
                        'top_notes' => $top_notes,
                        'base_notes' => $base_notes,
                        'heart_notes' => $heart_notes,
                        'launch_year' => $launch_year,
                        'description' => $description,
                        'perfume_type' => $perfume_type,
                        'family' => $family,
                        'subfamily' => $subfamily,
                        'ingredients' => $ingredients,
                        'occasion' => $occasion,
                        'sold' => $sold,
                        'season' => $season,
                        'capacity' => $capacity,
                        'image_name' => $image_name,
                        'image_name2' => $image_name2,
                        'image_name3' => $image_name3
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

    public function filterAction($param)
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $productModel = new ProductModel($db);
                $rows = array();

                $result = $productModel->filter($param);
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $post_item = array(
                        'id' => $id,
                        'brand' => $brand,
                        'gender' => $gender,
                        'perfume_name' => $perfume_name,
                        'stock' => $stock,
                        'price' => $price,
                        'top_notes' => $top_notes,
                        'base_notes' => $base_notes,
                        'heart_notes' => $heart_notes,
                        'launch_year' => $launch_year,
                        'description' => $description,
                        'perfume_type' => $perfume_type,
                        'family' => $family,
                        'subfamily' => $subfamily,
                        'ingredients' => $ingredients,
                        'occasion' => $occasion,
                        'sold' => $sold,
                        'season' => $season,
                        'capacity' => $capacity,
                        'image_name' => $image_name,
                        'image_name2' => $image_name2,
                        'image_name3' => $image_name3
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
                $productModel = new ProductModel($db);
                $productModel->id = $paramId;
                // Get post
                $productModel->read_single();
                $post_item = array(
                    'id' => $productModel->id,
                    'brand' => $productModel->brand,
                    'gender' => $productModel->gender,
                    'perfume_name' => $productModel->perfume_name,
                    'stock' => $productModel->stock,
                    'price' => $productModel->price,
                    'top_notes' => $productModel->top_notes,
                    'base_notes' => $productModel->base_notes,
                    'heart_notes' => $productModel->heart_notes,
                    'launch_year' => $productModel->launch_year,
                    'description' => $productModel->description,
                    'perfume_type' => $productModel->perfume_type,
                    'family' => $productModel->family,
                    'subfamily' => $productModel->subfamily,
                    'ingredients' => $productModel->ingredients,
                    'occasion' => $productModel->occasion,
                    'sold' => $productModel->sold,
                    'season' => $productModel->season,
                    'capacity' => $productModel->capacity,
                    'image_name' => $productModel->image_name,
                    'image_name2' => $productModel->image_name2,
                    'image_name3' => $productModel->image_name3
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
                $product = new ProductModel($db);

                //Get raw posted data
                $data = json_decode(file_get_contents("php://input"));

                $product->brand = $data->brand;
                $product->gender = $data->gender;
                $product->perfume_name = $data->perfume_name;
                $product->stock = $data->stock;
                $product->price = $data->price;
                $product->top_notes = $data->top_notes;
                $product->base_notes = $data->base_notes;
                $product->heart_notes = $data->heart_notes;
                $product->launch_year = $data->launch_year;
                $product->description = $data->description;
                $product->perfume_type = $data->perfume_type;
                $product->ingredients = $data->ingredients;
                $product->family = $data->family;
                $product->subfamily = $data->subfamily;
                $product->sold = $data->sold;
                $product->occasion = $data->occasion;
                $product->season = $data->season;
                $product->capacity = $data->capacity;
                $product->image_name = $data->image_name;
                $product->image_name2 = $data->image_name2;
                $product->image_name3 = $data->image_name3;

                //Create post
                if ($product->create()) {
                    echo json_encode(
                        array('message' => 'ProductModel Created')
                    );
                } else {
                    echo json_encode(
                        array('message' => 'ProductModel Not Created')
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
                $product = new ProductModel($db);

                //Get raw posted data
                $data = json_decode(file_get_contents("php://input"));

                $product->brand = $data->brand;
                $product->gender = $data->gender;
                $product->perfume_name = $data->perfume_name;
                $product->stock = $data->stock;
                $product->price = $data->price;
                $product->top_notes = $data->top_notes;
                $product->base_notes = $data->base_notes;
                $product->heart_notes = $data->heart_notes;
                $product->launch_year = $data->launch_year;
                $product->description = $data->description;
                $product->perfume_type = $data->perfume_type;
                $product->ingredients = $data->ingredients;
                $product->family = $data->family;
                $product->subfamily = $data->subfamily;
                $product->sold = $data->sold;
                $product->occasion = $data->occasion;
                $product->season = $data->season;
                $product->capacity = $data->capacity;
                $product->image_name = $data->image_name;
                $product->image_name2 = $data->image_name2;
                $product->image_name3 = $data->image_name3;

                //Create post
                if ($product->update()) {
                    echo json_encode(
                        array('message' => 'ProductModel with ID ' . $paramId . ' Updated')
                    );
                } else {
                    echo json_encode(
                        array('message' => 'ProductModel with ID ' . $paramId . ' Not Updated')
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
                $product = new ProductModel($db);

                //Get raw posted data
                $data = json_decode(file_get_contents("php://input"));

                $product->id = $paramId;


                //Create post
                if ($product->delete()) {
                    echo json_encode(
                        array('message' => 'ProductModel with ID ' . $paramId . ' Deleted')
                    );
                } else {
                    echo json_encode(
                        array('message' => 'ProductModel with ID ' . $paramId . ' Not Deleted')
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

    public function getMostSoldAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $productModel = new ProductModel($db);
                $rows = array();

                $result = $productModel->getMostSold();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $post_item = array(
                        'family' => $family,
                        'sold' => $mostSold,
                        'price' => $totalPrice
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

    public function getStocksAction()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $productModel = new ProductModel($db);
                $rows = array();

                $result = $productModel->getStocks();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $post_item = array(
                        'brand' => $brand,
                        'perfume_name' => $perfume_name,
                        'stock' => $stock
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

    public function getSoldLast30DaysAction(){
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if (strtoupper($requestMethod) == 'GET') {
            try {
                $database = new Database();
                $db = $database->connect();
                $productModel = new ProductModel($db);
                $rows = array();

                $result = $productModel->getSoldLast30Days();
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    $post_item = array(
                        'Orders' => $Orders,
                        'Revenue' => $Revenue
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


}
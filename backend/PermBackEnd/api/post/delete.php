<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,
 Authorization, X-Requested-Width');

include_once '../../config/Database.php';
include_once '../../models/UserModel.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//Instantiate blog post object
$post = new UserModel($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set id to update
$post->id = $data->id;

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//Update
if ($post->delete()) {
    echo json_encode(
        array('message' => 'UserModel Deleted')
    );
} else {
    echo json_encode(
        array('message' => 'UserModel Not Deleted')
    );
}
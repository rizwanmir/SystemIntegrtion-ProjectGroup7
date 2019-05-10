<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate books object
include_once '../objects/books.php';
 
$database = new Database();
$db = $database->getConnection();
 
$books = new Books($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->title) &&
    !empty($data->isbn) &&
    !empty($data->author_id) &&
    !empty($data->publisher_id) &&
    !empty($data->category) &&
    !empty($data->pages) 
    
){
 
    // set books property values
    $books->title = $data->title;
    $books->isbn = $data->isbn;
    $books->author_id = $data->author_id;
    $books->publisher_id = $data->publisher_id;
    $books->category = $data->category;
    $books->pages = $data->pages;
    
 
    // create the books
    if($books->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "oo was created."));
    }
 
    // if unable to create the books, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create books."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create books. Data is incomplete."));
}
?>
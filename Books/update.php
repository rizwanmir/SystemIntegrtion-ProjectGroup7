<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/books.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare books object
$books = new Books($db);
 
// get id of books to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of books to be edited
$books->id = $data->id;
 
// set books property values
$books->title = $data->title;
$books->isbn = $data->isbn;
$books->author_id = $data->author_id;
$books->publisher_id = $data->publisher_id;
$books->category = $data->category;
$books->pages= $data->pages;
 
// update the books
if($books->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "books was updated."));
}
 
// if unable to update the books, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update books."));
}
?>
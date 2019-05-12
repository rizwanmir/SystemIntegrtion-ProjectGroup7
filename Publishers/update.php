<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/publishers.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare books object
$publishers = new Publishers($db);
 
// get id of books to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of books to be edited
$publishers->id = $data->id;
 
// set books property values
$publishers->publisher = $data->publisher;
$publishers->location = $data->location;

 
// update the books
if($publishers->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Publisher was updated."));
}
 
// if unable to update the books, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update publisher."));
}
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once '../config/database.php';
include_once '../objects/authors.php';
 
$database = new Database();
$db = $database->getConnection();
 
$authors = new Authors($db);
 
$authors->id = isset($_GET['id']) ? $_GET['id'] : die();
 
$authors->readOne();
 
if($authors->first_name!=null){
    
    $authors_arr = array(
        "id" => $authors->id,
        "first_name" => $authors->first_name,
        "last_name" => $authors->last_name,
         "place_of_birth" => $authors->place_of_birth
 
    );
 
    
    http_response_code(200);
 
    
    echo json_encode($authors_arr);
}
 
else{
    
    http_response_code(404);
 
    
    echo json_encode(array("message" => "author does not exist."));
}
?>
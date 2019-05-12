<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once '../config/database.php';
include_once '../objects/publishers.php';
 
$database = new Database();
$db = $database->getConnection();
 
$publishers = new Publishers($db);
 
$publishers->id = isset($_GET['id']) ? $_GET['id'] : die();
 
$publishers->readOne();
 
if($publishers->publisher!=null){
    
    $publishers_arr = array(
        "id" => $publishers->id,
        "publisher" => $publishers->publisher,
        "location" => $publishers->location
 
    );
 
    
    http_response_code(200);
 
    
    echo json_encode($publishers_arr);
}
 
else{
    
    http_response_code(404);
 
    
    echo json_encode(array("message" => "publisher does not exist."));
}
?>
<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 

include_once '../config/database.php';
include_once '../objects/product.php';
 

$database = new Database();
$db = $database->getConnection();
 

$product = new Product($db);
 

$product->id = isset($_GET['id']) ? $_GET['id'] : die();
 

$product->readOne();
 
if($product->title!=null){
    
    $product_arr = array(
        "id" =>  $product->id,
        "title" => $product->title,
        "isbn" => $product->isbn,
        "author_id" => $product->author_id,
        "publisher_id" => $product->publisher_id,
        "category" => $product->category,
        "pages" => $product->pages
 
    );
 
    
    http_response_code(200);
 
    
    echo json_encode($product_arr);
}
 
else{
    
    http_response_code(404);
 
    
    echo json_encode(array("message" => "Product does not exist."));
}
?>
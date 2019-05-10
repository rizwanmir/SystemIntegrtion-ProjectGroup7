<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once '../config/database.php';
include_once '../objects/books.php';
 
$database = new Database();
$db = $database->getConnection();
 
$books = new Books($db);
 
$books->id = isset($_GET['id']) ? $_GET['id'] : die();
 
$books->readOne();
 
if($books->title!=null){
    
    $books_arr = array(
        "id" =>  $books->id,
        "title" => $books->title,
        "isbn" => $books->isbn,
        "author_id" => $books->author_id,
        "publisher_id" => $books->publisher_id,
        "category" => $books->category,
        "pages" => $books->pages
 
    );
 
    
    http_response_code(200);
 
    
    echo json_encode($books_arr);
}
 
else{
    
    http_response_code(404);
 
    
    echo json_encode(array("message" => "books does not exist."));
}
?>
<?php
include_once '../config/database.php';
include_once '../objects/books.php';

$database = new Database();
$db = $database->getConnection();
$valid_user = false;
if (isset($_GET['apikey'])) {
    // Check if apikey is valid.

    $apikey = $_GET['apikey'];
    $sql = 'SELECT * FROM api WHERE apikey = :apikey';
    $statement = $db->prepare($sql);
    $statement->bindValue(':apikey', $apikey, PDO::PARAM_STR);
    $data = $statement->execute();
    if ($data = $statement->fetch()) {
        // Apikey is valid.
        $valid_user = true;
        $_SESSION['apikey'] = $apikey;
        echo json_encode(array("message" => "it works."));
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
    }
}
if (!$valid_user) {
    http_response_code(401);
    echo json_encode(array("message" => "You need a Key."));
    exit;
}

?>

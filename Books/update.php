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
        
    }

}
if (!$valid_user) {
    http_response_code(401);
    echo json_encode(array("message" => "You need a Key."));
    exit;
}

?>
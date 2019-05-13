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
        
    }

}
if (!$valid_user) {
    http_response_code(401);
    echo json_encode(array("message" => "You need a Key."));
    exit;
}

?>
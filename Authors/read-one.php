<?php
include_once '../config/database.php';
include_once '../objects/authors.php';

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
        
    }
}
if (!$valid_user) {
    http_response_code(401);
    echo json_encode(array("message" => "You need a Key."));
    exit;
}
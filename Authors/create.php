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
      //  include_once '../config/database.php';
 
// instantiate authors object
 
$authors = new Authors($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->first_name) &&
    !empty($data->last_name) &&
    !empty($data->place_of_birth)
    
){
 
    // set books property values
    $authors->first_name = $data->first_name;
    $authors->last_name = $data->last_name;
    $authors->place_of_birth = $data->place_of_birth;
    
    
 
    // create the books
    if($authors->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Author was created."));
    }
 
    // if unable to create the books, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create author."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("message" => "Unable to create Authors. Data is incomplete."));
}
        
    }
}
if (!$valid_user) {
    http_response_code(401);
    echo json_encode(array("message" => "You need a Key."));
    exit;
}
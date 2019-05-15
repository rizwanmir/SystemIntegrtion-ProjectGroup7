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
 
// get id of author to be edited
$data = json_decode(file_get_contents("php://input"));
 
// set ID property of author to be edited
$authors->id = $data->id;
 
// set author property values
$authors->first_name = $data->first_name;
$authors->last_name = $data->last_name;
$authors->place_of_birth = $data->place_of_birth;
 
// update the author
if($authors->update()){
 
    // set response code - 200 ok
    http_response_code(200);
 
    // tell the user
    echo json_encode(array("message" => "Authors was updated."));
}
 
// if unable to update the author, tell the user
else{
 
    // set response code - 503 service unavailable
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("message" => "Unable to update Authors."));
}
        
    }
}
if (!$valid_user) {
    http_response_code(401);
    echo json_encode(array("message" => "You need a Key."));
    exit;
}
?>
<?php
include_once '../config/database.php';
include_once '../objects/publishers.php';

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
        
    }

}
if (!$valid_user) {
    http_response_code(401);
    echo json_encode(array("message" => "You need a Key."));
    exit;
}

?>
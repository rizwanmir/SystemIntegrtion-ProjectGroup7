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
 
$stmt = $publishers->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // publishers array
    $publishers_arr=array();
    $publishers_arr["records"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
 
        $publishers_item=array(
            "id" => $id,
            "publisher" => $publisher,
            "location" => $location
        );
 
        array_push($publishers_arr["records"], $publishers_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show bookss data in json format
    echo json_encode($publishers_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no bookss found
    echo json_encode(
        array("message" => "No publishers found.")
    );
}
        
    }

}
if (!$valid_user) {
    http_response_code(401);
    echo json_encode(array("message" => "You need a Key."));
    exit;
}

?>
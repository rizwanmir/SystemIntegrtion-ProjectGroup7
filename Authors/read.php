<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/authors.php';
 
$database = new Database();
$db = $database->getConnection();
 
$authors = new Authors($db);
 
// query bookss
$stmt = $authors->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // bookss array
    $authors_arr=array();
    $authors_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $authors_item=array(
            "id" => $id,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "place_of_birth" => $place_of_birth
        );
 
        array_push($authors_arr["records"], $authors_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show bookss data in json format
    echo json_encode($authors_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no bookss found
    echo json_encode(
        array("message" => "No authors found.")
    );
}
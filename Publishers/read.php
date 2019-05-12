<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
include_once '../objects/publishers.php';
 
$database = new Database();
$db = $database->getConnection();
 
$publishers = new Publishers($db);
 
// query bookss
$stmt = $publishers->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // bookss array
    $publishers_arr=array();
    $publishers_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
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
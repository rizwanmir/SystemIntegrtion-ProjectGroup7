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
 
// query bookss
$stmt = $books->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // bookss array
    $bookss_arr=array();
    $bookss_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $books_item=array(
            "id" => $id,
            "title" => $title,
            "isbn" => $isbn,
            "author_id" => $author_id,
            "publisher_id" => $publisher_id,
            "category" => $category,
            "pages" => $pages
        );
 
        array_push($bookss_arr["records"], $books_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show bookss data in json format
    echo json_encode($bookss_arr);
}
 
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no bookss found
    echo json_encode(
        array("message" => "No bookss found.")
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
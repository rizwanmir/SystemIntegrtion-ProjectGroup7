<?php
class Publishers{
 
    // database connection and table name
    private $conn;
    private $table_name = "publisher";
 
    // object properties
    public $id;
    public $title;
    public $isbn;
    public $author_id;
    public $publisher_id;
    public $category;
    public $pages;
    public $first_name;
    public $last_name;
    public $place_of_birth;
    public $publisher;
    public $location;
    
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read books
    function read(){
 
        // select all query
        $query =  "SELECT * FROM publisher";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }
// create books
function create(){
 
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                publisher=:publisher, location=:location";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize 
    
    $this->publisher=htmlspecialchars(strip_tags($this->publisher));
    $this->location=htmlspecialchars(strip_tags($this->location));
    
    
 
    // bind values
    $stmt->bindParam(":publisher", $this->publisher);
    $stmt->bindParam(":location", $this->location);
    
   
    
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
// used when filling up the update books form
function readOne(){
 
    // query to read single record
    $query = "SELECT * FROM publisher
            WHERE
                id = ?
            LIMIT
                0,1";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind id of books to be updated
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
 
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // set values to object properties
    $this->publisher = $row['publisher'];
    $this->location = $row['location'];
    
    
}
// update the books
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
            publisher=:publisher, location=:location
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->publisher=htmlspecialchars(strip_tags($this->publisher));
    $this->location=htmlspecialchars(strip_tags($this->location));
 
    // bind new values
    $stmt->bindParam(":publisher", $this->publisher);
    $stmt->bindParam(":location", $this->location);
    $stmt->bindParam(":id", $this->id);

 
    // execute the query
    if($stmt->execute()){
        return true;
    }
 
    return false;
}
// delete the books
function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind id of record to delete
    $stmt->bindParam(1, $this->id);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
}
<?php
class Authors{
 
    // database connection and table name
    private $conn;
    private $table_name = "authors";
 
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
    
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read books
    function read(){
 
        // select all query
        $query =  "SELECT * FROM authors";
     
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
                first_name=:first_name, last_name=:last_name, place_of_birth=:place_of_birth";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize 
    
    $this->first_name=htmlspecialchars(strip_tags($this->first_name));
    $this->last_name=htmlspecialchars(strip_tags($this->last_name));
    $this->place_of_birth=htmlspecialchars(strip_tags($this->place_of_birth));
    
 
    // bind values
    $stmt->bindParam(":first_name", $this->first_name);
    $stmt->bindParam(":last_name", $this->last_name);
    $stmt->bindParam(":place_of_birth", $this->place_of_birth);
   
    
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
// used when filling up the update books form
function readOne(){
 
    // query to read single record
    $query = "SELECT * FROM authors
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
    $this->first_name = $row['first_name'];
    $this->last_name = $row['last_name'];
    $this->place_of_birth = $row['place_of_birth'];
    
}
// update the books
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
            first_name=:first_name, last_name=:last_name, place_of_birth=:place_of_birth
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->first_name=htmlspecialchars(strip_tags($this->first_name));
    $this->last_name=htmlspecialchars(strip_tags($this->last_name));
    $this->place_of_birth=htmlspecialchars(strip_tags($this->place_of_birth));
 
    // bind new values
    $stmt->bindParam(":first_name", $this->first_name);
    $stmt->bindParam(":last_name", $this->last_name);
    $stmt->bindParam(":place_of_birth", $this->place_of_birth);
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
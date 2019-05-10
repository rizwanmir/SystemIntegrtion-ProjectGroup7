<?php
class Books{
 
    // database connection and table name
    private $conn;
    private $table_name = "books";
 
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
        $query =  "SELECT b.id, b.title, b.isbn, b.category, b.pages, a.id as author_id, p.id as publisher_id FROM books b
                     LEFT JOIN authors a ON b.author_id = a.id
                     LEFT JOIN publisher p ON b.publisher_id = p.id";
     
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
                title=:title, isbn=:isbn, author_id=:author_id, publisher_id=:publisher_id, category=:category, pages=:pages";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize 
    
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->isbn=htmlspecialchars(strip_tags($this->isbn));
    $this->author_id=htmlspecialchars(strip_tags($this->author_id));
    $this->publisher_id=htmlspecialchars(strip_tags($this->publisher_id));
    $this->category=htmlspecialchars(strip_tags($this->category));
    $this->pages=htmlspecialchars(strip_tags($this->pages));
 
    // bind values
    $stmt->bindParam(":title", $this->title);
    $stmt->bindParam(":isbn", $this->isbn);
    $stmt->bindParam(":author_id", $this->author_id);
    $stmt->bindParam(":publisher_id", $this->publisher_id);
    $stmt->bindParam(":category", $this->category);
    $stmt->bindParam(":pages", $this->pages);
    
 
    // execute query
    if($stmt->execute()){
        return true;
    }
 
    return false;
     
}
// used when filling up the update books form
function readOne(){
 
    // query to read single record
    $query = "SELECT b.id, b.title, b.isbn, b.category, b.pages, a.id as author_id, p.id as publisher_id FROM books b
                LEFT JOIN authors a ON b.author_id = a.id
                LEFT JOIN publisher p ON b.publisher_id = p.id
            WHERE
                b.id = ?
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
    $this->title = $row['title'];
    $this->isbn = $row['isbn'];
    $this->author_id = $row['author_id'];
    $this->publisher_id = $row['publisher_id'];
    $this->category = $row['category'];
    $this->pages = $row['pages'];
}
// update the books
function update(){
 
    // update query
    $query = "UPDATE
                " . $this->table_name . "
            SET
                title = :title,
                isbn = :isbn,
                author_id = :author_id,
                publisher_id = :publisher_id,
                category = :category,
                pages = :pages
            WHERE
                id = :id";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->title=htmlspecialchars(strip_tags($this->title));
    $this->isbn=htmlspecialchars(strip_tags($this->isbn));
    $this->author_id=htmlspecialchars(strip_tags($this->author_id));
    $this->publisher_id=htmlspecialchars(strip_tags($this->publisher_id));
    $this->category=htmlspecialchars(strip_tags($this->category));
    $this->pages=htmlspecialchars(strip_tags($this->pages));
    $this->id=htmlspecialchars(strip_tags($this->id));
 
    // bind new values
    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':isbn', $this->isbn);
    $stmt->bindParam(':author_id', $this->author_id);
    $stmt->bindParam(':publisher_id', $this->publisher_id);
    $stmt->bindParam(':category', $this->category);
    $stmt->bindParam(':pages', $this->pages);
    $stmt->bindParam(':id', $this->id);
 
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
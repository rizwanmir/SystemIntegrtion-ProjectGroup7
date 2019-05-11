<?php
class Api {
    private $conn;
    function __construct($db) {
        $this->conn = $db;
    }
    
    public function create($email, $apikey) {
        try {
            $stmt = $this->conn->prepare("INSERT INTO api (email, apikey) 
            VALUES(:email, :apikey)");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":apikey", $apikey);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>
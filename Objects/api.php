<?php
class Api {
    private $conn;
    function __construct($db) {
        $this->conn = $db;
    }
    
    public function insertApiKey($email, $apikey) {
        $id =  $this->conn->prepare("SELECT id FROM users WHERE email = :email");
        $id->bindValue(':email', $email, PDO::PARAM_STR);
        if ($id->execute()){
            foreach ($id as $value) {
             //   echo $value[0];
             //   echo $apikey;
                $stmt = $this->conn->prepare("INSERT INTO api (user_id, apikey) VALUES (:user_id, :apikey)");
                $stmt->bindValue(':user_id', $value[0], PDO::PARAM_STR);
                $stmt->bindValue(':apikey', $apikey, PDO::PARAM_STR);
                if ($stmt->execute()) {
                    echo 'look in the database';
                } else {
                    echo 'does not work';
                }
            }

        } else {
            echo 'error';
        }     
    }
 } 
?>
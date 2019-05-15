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
                $stmt = $this->conn->prepare("SELECT user_id FROM api WHERE user_id = :id");
                $stmt->bindValue(':id', $value[0], PDO::PARAM_STR);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $apikey2 = $this->conn->prepare("SELECT apikey FROM api WHERE user_id = :id");
                    $apikey2->bindValue(':id', $value[0], PDO::PARAM_STR);
                    if ($apikey2->execute()) {
                        foreach ($apikey2 as $apivalue) {
                            echo 'You allready have an apikey. Your apikey is: ' . $apivalue[0];
                        }
                    }
                } else {

                    $stmt = $this->conn->prepare("INSERT INTO api (user_id, apikey) VALUES (:user_id, :apikey)");
                    $stmt->bindValue(':user_id', $value[0], PDO::PARAM_STR);
                    $stmt->bindValue(':apikey', $apikey, PDO::PARAM_STR);
                    if ($stmt->execute()) {
                       echo '';
                    } else {
                        echo 'does not work';
                    }
                }
             //   echo $value[0];
             //   echo $apikey;
            }

        } else {
            echo 'error';
        }     
    }
 } 
?>
<?php

// This script has a USER class and Admin class which extending
// the first, both classes lies in their constructors one function
// for each, which is used in login process.


include('config/database.php');
$database = new Database;
$db = $database->getConnection();

class User {

    public $email;
    public $firstName;
    public $lastName;
    public $password;
    



    function __construct() {
        
        $this->email =  $_POST['email'] ?? '';
        $this->email =  filter_var($this->email, FILTER_VALIDATE_EMAIL);
        $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $this->password = $_POST['password'] ?? '';
        $this->password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            }	
    public function login($email, $password) {
            global $db;
            $stmt = $db->prepare("SELECT id FROM users WHERE email = ? AND password = ? ;");
            $stmt->execute(array($email, $password));
            $rowcount = $stmt->rowCount();
            $userLoggedIn = ($rowcount = 1);
                if ($userLoggedIn) {
                 $userId = $stmt->fetchColumn();
                
                if($userId){
                    $_SESSION['userId'] = $userId;
                    $_SESSION['last_login'] = time();
                    return $userId;
            }
        }
    }            



}

?>
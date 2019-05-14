<?php

//  This script is used for user Signing up page.

require_once('../Config/database.php');

$database = new Database;
$db = $database->getConnection();

class Registerations {

    public $email;
    public $password;
      
    function __construct() {	

        $this->email =  $_POST['email'] ?? '';
        $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        
        $this->password = $_POST['password'] ?? '';
        $this->password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        
        }
        

            }	
            
$new_register = new Registerations;

if(isset($_POST['submit'])){
    

$sql = "INSERT INTO users (email, password)
VALUES (?,?)";
$stmt = $db->prepare($sql)->execute([$new_register->email, $new_register->password]);
if($stmt){
    header("Location: ../loginform.php");
    }else{
        echo 'error';
    }

}
 



<?php

// This page handels both user and admin login based on
// the page that refered to this script. 

include_once('userClass.php');

$user = new User;
$userExists = $user->login($user->email, $user->password);

if($userExists){
    header("Location: ../apikey_generator.php");
die();
   
}else{
    echo "user was NOT found";

}

?>
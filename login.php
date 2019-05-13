<?php
include_once './Config/database.php';
include_once './Objects/api.php';
$database = new Database();
$db = $database->getConnection();
 
$api = new Api($db);
if(isset($_POST['submit'])) {
     
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $apikey = uniqid();
    if($api->create($email, $apikey)) {
        echo "Your API key is: $apikey";
    } else {
        echo "Something went wrong";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Add Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <body>
        <div class="getapi">
    <form action="login.php" method="POST">
            <input type="text" placeholder=" enter your email" name="email">

            <input type="submit" name="submit" value="Get API key">
            </form>
        </div>
        </body>
</html> 
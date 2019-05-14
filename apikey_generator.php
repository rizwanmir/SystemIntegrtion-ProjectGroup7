<?php
include_once './Config/database.php';
include_once './Objects/api.php';
$database = new Database();
$db = $database->getConnection();
 
if(isset($_POST['submit'])) {
    $api = new Api($db);
     
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $apikey = uniqid();
 //   if($api->create($email, $apikey)) {
        $msg  = "<div id='apikey'>";
        $msg .= "Your API key is: $apikey";
        $msg .= "</div>";
        $api->insertApiKey($email, $apikey);
    } 

?>
<!DOCTYPE HTML>
<html>
<head>
<title> Get yor API KEY </title>
<style>
#apiform {
    height: 281px;
    width: 400px;
    background-color: cadetblue;
    padding: 15px;
    margin: 5px;
    position: absolute;

left: 426px;

top: 129px;
}
#submit {
    width: 213px;
    height: 49px;
}
#email {
    width: 307px;
    height: 28px;
}

#apikey {
    height: 34px;
    width: 269px;
    background-color: yellowgreen;
    color: azure;
    padding: 5px;
    margin: 61px;
    line-height: 1.5em;
}
p {
    color: white;
}
</style>
</head>
<body>
<div id="apiform">
<form action="apikey_generator.php" method="post">
<p>Enter your e-mail to get API KEY!</p>
<input type="email" id="email" name="email"><br><br>
<input type="submit" id="submit" name="submit" value="Get yor API KEY">
<?php if(isset($msg)) echo $msg; else{$msg = "";} ?>
</form>
</div> <!-- End of apiform -->
</body>
</html>










<?php

?>
<!DOCTYPE HTML>
<html>
<head>
<title></title>
<meta charset="UTF8">
</head>
<body>
<div id="userlogin"> 
  <form action="objects/login.php" method="post">
  <label for="email">Email:&nbsp &nbsp  &nbsp   &nbsp
  <input type="text" name="email" placeholder="e.g. mail@mail.com"></label> </br></br>
  <label for="password">Password:&nbsp 
  <input type="password"  name="password" placeholder="Enter your password!"></label> </br></br></br>
  <div class="lower">
  <div class="inline-field"><label for="checkbox"> <input type="checkbox" name="remember"
  <?php if(isset($_COOKIE['user'])) {
		echo 'checked="checked"';
	}
	else {
		echo '';
	}
	?>>Keep me logged in</label>
  <input type="submit" name="login" value="Login">
</div>
  </br></br>
  <hr>
  <p>No account? <a href="signup.php">Create one!</a></p></br></br></br>

</div><!--/ lower-->
  </form>
  
  </div>
  </body>
  </html>

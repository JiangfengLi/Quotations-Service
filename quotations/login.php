<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sessions Login.php</title>
<link rel="stylesheet" href="style.css">
</head>
<?php
session_start ();
  // TODO 2: Consider an HTML form that calls the controller.  Why a form? 
  // Because control transfers to contoller.php when the button is clicked
  // That would be the third page loaded in this scenario of login.
?>

<h3>Login</h3>
	<form action="controller.php" method="POST" class="submenu2">
		Username <input type="text" name="ID" value=""><br>
		<br>
		Password <input type="password" name="ID_PW" value=""><br> <br>
	<input type="submit" name="Login" value="Login" class="middle"> <br> <br>
<?php
	
  // TODO 9: Show message indicating the credentials were not Rick and 1234
  if( isset(  $_SESSION['loginError']))
    echo  $_SESSION['loginError'];	
?>
</form>
</body>
</html>

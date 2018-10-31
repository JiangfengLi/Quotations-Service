<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sessions register.php</title>
<link rel="stylesheet" href="style.css">
</head>
<?php
session_start ();
  // TODO 2: Consider an HTML form that calls the controller.  Why a form? 
  // Because control transfers to contoller.php when the button is clicked
  // That would be the third page loaded in this scenario of login.
?>

<h3>Register</h3>
	<form action="controller.php" method="POST" class="submenu2">
		Username <input type="text" name="Username" value="" pattern=".{4,}" required title="username must be 4 characters"><br>
		<br>
		Password<input type="password" name="setPW" value="" pattern=".{6,}" required title="password must be 6 characters"><br> <br>
	<input type="submit" name="Register" value="Register" class="middle"> <br> <br>
	
<?php
 	
  // TODO 9: Show message indicating that the credentials exist
  if( isset(  $_SESSION['registerError']))
    echo  $_SESSION['registerError'];	
?>
</form>
</body>
</html>

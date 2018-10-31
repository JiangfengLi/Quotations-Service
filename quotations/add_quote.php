<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sessions Add_quotes.php</title>
<link rel="stylesheet" href="style.css">
</head>
<?php
session_start ();
  // TODO 2: Consider an HTML form that calls the controller.  Why a form? 
  // Because control transfers to contoller.php when the button is clicked
  // That would be the third page loaded in this scenario of login.
?>

<h3>Add a Quote</h3>
	<form action="controller.php" method="POST" class="submenu2">
		Quote: <textarea rows="5" cols="50" name="newquote" placeholder="Enter new quote" required></textarea><br>
		
		Author: <input type="text" name="quoteAuthor" placeholder="Author" required><br> <br>
	<input type="submit" name="insertQuote" value="Add Quote" class="middle"> <br> <br>
<?php
	
  // TODO 9: Show message indicating the credentials were not Rick and 1234
  if( isset(  $_SESSION['addQuoteError']))
    echo  $_SESSION['addQuoteError'];	
?>
</form>
</body>
</html>

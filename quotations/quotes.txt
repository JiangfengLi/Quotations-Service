<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sessions index.php</title>
<link rel="stylesheet" href="style.css">
</head>
<body onload="showAllquotes()">
<?php
// TODO 0: Explain session_start() and the need this include BankAccount. The
// include must be BEFORE session_start to avoid a really weird serialization error!!!!
// require_once './BankAccount.php';
// Need session_start in every file using the global array $_SESSION['index'].
// If you do not include session_start(), you will get a 'silent; error.
// The code does not work. Threre are no warning or error message anywhere!
session_start();

// TODO 1: Start a simple menu system with an href to login.php
?>

	<h3>Quotation Service</h3>
	<br>
	<div class="Menus">
		<span class="box"><a href="register.php">Register</a></span> <span
			class="box"><a href="login.php">Login</a></span> <span class="box"><a
			href="add_quote.php">Add Quote</a></span> <br><br>

	</div>
	
<?php
// TODO 5: Show the current balance and user name if someone is logged in 
if (isset( $_SESSION ['login'] )) {
    echo 
      '<form action="controller.php" method="POST">'.      
       '  <input type="submit" name="UnflagAll" value="Unflag All">'.
       ' <input type="submit" name="Logout" value="Logout">'.
       '</form>';
}
// TODO x10: Consider the form that responds on logout
?>

    
	<div id="divTochange"></div>

	<script>    
	function showAllquotes(){
	    var lists = document.getElementById("divTochange"); 
		var ajax = new XMLHttpRequest();
		  // No query parameter needed, no GET used on the server side
	    ajax.open("GET", "controller.php?getAllquotes", true);
	    ajax.send();
		  // This anonymous callback will execute when the server responds
		console.log("State: " + ajax.readyState);
	    ajax.onreadystatechange = function() {
		  if (ajax.readyState == 4 && ajax.status == 200) {
				var array = JSON.parse(ajax.responseText);
				console.log(array);
				lists.innerHTML = "";
				for(var i = 0; i < array.length; i++){
				  if(array[i]['flagged'] == 0){
					lists.innerHTML += '<div class="quote">'
					                 + '"' + array[i]['quote'] + '"'
					                 + '<p>--' + array[i]['author'] + '</p>'
					                 + '<button onclick="plus('+ array[i]['id'] +
					                 ')">+</button> <span id="count">'+array[i]['rating'] +'</span>'
					                 + ' <button onclick="minus(' + array[i]['id'] + ')">-</button>'
					                 + '&nbsp&nbsp<button onclick="Flag(' + array[i]['id'] + ')" > Flag </button>'
					                 + '</div>';
				  }
				}
		    }
		  } // End anonymous function	
	    }

	    function Flag(id){
			var ajax = new XMLHttpRequest();
			  // No query parameter needed, no GET used on the server side
		    ajax.open("GET", "controller.php?flag=" + id, true);
		    ajax.send();
			  // This anonymous callback will execute when the server responds
		    ajax.onreadystatechange = function() {
			  if (ajax.readyState == 4 && ajax.status == 200) {
				  showAllquotes();
			  }
			} // End anonymous function		    	
	    }	    
	    
	    function UnflagAll(){
			var ajax = new XMLHttpRequest();
			  // No query parameter needed, no GET used on the server side
		    ajax.open("GET", "controller.php?UnflagAll", true);
		    ajax.send();
			  // This anonymous callback will execute when the server responds
		    ajax.onreadystatechange = function() {
			  if (ajax.readyState == 4 && ajax.status == 200) {
				  showAllquotes();
			  }
			} // End anonymous function	
	    	
	    }	    
    
	function minus(id){
		var ajax = new XMLHttpRequest();
	  // No query parameter needed, no GET used on the server side
		ajax.open("GET", "controller.php?Minus=" + id, true);
		ajax.send();
		// This anonymous callback will execute when the server responds
	    ajax.onreadystatechange = function() {
			if (ajax.readyState == 4 && ajax.status == 200) {
				showAllquotes();
		    }
	    } // End anonymous function		    	
	}
	    
	    
	function plus(id){    
		var ajax = new XMLHttpRequest();
			  // No query parameter needed, no GET used on the server side
		ajax.open("GET", "controller.php?Add=" + id, true);
		ajax.send();
		// This anonymous callback will execute when the server responds
	    ajax.onreadystatechange = function() {
			if (ajax.readyState == 4 && ajax.status == 200) {
				showAllquotes();
		    }
	     } // End anonymous function	
	} 
	    	
	</script>

<br>
	<br>
</body>
</html>
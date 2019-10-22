<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$first_name = $_POST['first_name'];

	// To set a cookie, provide a name and value
	setcookie("fName", $first_name);
	// Once the cookie is set in the browser, the browser will send the cookie to the server
	// each time a page is requested, which allows you to use PHP to access the cookie 

	// By default, a cookie will expire when the session ends
	// to set a different expiration date, add a third param (this cookie would expire in a year)
	//       setcookie("fName", $first_name , time() + (60 * 60 * 24 * 365));



	echo("<h3>A cookie has been set in your browser, it's name is 'fName' and it's value is $first_name</h3>");
	echo("<a href='get-cookie.php'>Click</a> to visit another page on this site that uses the cookie.");
}
?>
<form method="POST">
	<label>Enter your name and I will set a cookie in your browser:</label>
	<input type="text" name="first_name"/>
	<input type="submit" value="GO">
</form>

<?php
// In order to make use of session variables in PHP, you must call this function:
session_start(); // put this code in the config file if all pages will use it

if($_SERVER['REQUEST_METHOD'] == "POST"){

	$first_name = $_POST['first_name'];
	echo("<h1>Hello $first_name!</h1>");

	// now store the first name in a session variable:
	$_SESSION['first_name'] = $first_name;

	echo('<br><a href="get-session-data.php">Click</a> to go to another page that uses the session variable.<br><br>');
}
?>

<form method="POST">
	Login ID:
	<br>
	<input type="text" placeholder="Enter first name" name="first_name">
	<br>
	Password:
	<br>
	<input type="password" placeholder="Enter anything here" name="">
	<br>
	<input type="submit" value="Log In">
</form>



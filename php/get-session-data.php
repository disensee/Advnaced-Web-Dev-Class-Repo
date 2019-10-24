<?php
session_start(); // put this code in the config file if all pages will use it

$name = "";

if(isset($_SESSION['first_name'])){
	$name = $_SESSION['first_name'];
}else{
	die("I don't have a session for you");
}

//After you get this code to work, kill the session by
//closing your browser (or switch to a different browser) navigate to this page 

?>
<h1>Hello <?php echo($name); ?>!<h1>
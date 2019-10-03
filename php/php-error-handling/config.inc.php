<?php


if($_SERVER['SERVER_NAME'] == "localhost"){
	define("SITE_ADMIN_EMAIL", "devloper@acme.com");
	define("DEBUG_MODE", true);
	// even though we will be running this code on local host in class
	// we may want to set the DEBUG_MODE to false just to see how it might behave on the live server
}else{
	define("SITE_ADMIN_EMAIL", "devloper@acme.com");
	define("DEBUG_MODE", false);
}

if(DEBUG_MODE){
	// turn on error messages
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}


// tell PHP to use our customErrorHandler() instead of the default function
set_error_handler("customErrorHandler");
// our custom exception handler function is defined below
set_exception_handler('customExceptionHandler');






// Instead of using the defualt PHP error handler function that gets called
// when and error occurs, we want this function to be called
function customErrorHandler($errno, $errstr, $errfile, $errline){

	$errorMsg = "<br><b>THIS IS OUR CUSTOM ERROR HANDLER</b>";
	$errorMsg .= "<br>ERROR NUMBER: " . $errno;
	$errorMsg .= "<br>ERROR MSG: " . $errstr;
	$errorMsg .= "<br>FILE: " . $errfile;
	$errorMsg .= "<br>LINE NUMBER: " . $errline;
	// In the future we may want to include many more details in our 
	// custom error message
	$errorMsg .= "<br> " . getAllSuperGlobals();
	if(DEBUG_MODE){
		// in debug mode we display all details of the error in the browser
		echo($errorMsg);
	}else{
		// when not debugging (on the live site) we don't want users to see ugly error messages
		// so instead, we get an email with the gory details and redirect users to our friendly error page.
		sendEmail(SITE_ADMIN_EMAIL, "WEBSITE ERROR!", $errorMsg . getAllSuperGlobals());
		header("Location: sorry.php");
		exit();
	}
}

function customExceptionHandler($exception) {
  
  	if(DEBUG_MODE){
  		var_dump($exception);
  	}else{
  		sendEmail(SITE_ADMIN_EMAIL, "WEBSITE EXCEPTION!", var_export($exception, true) . getAllSuperGlobals());
		header("Location: sorry.php");
		exit();
  	}
}


// Dumps all super globals to help us with debugging
function getAllSuperGlobals(){

	$str = "<br>POST VARS:<br>" . print_r($_POST, true);
	$str .= "<br>GET VARS:<br>" .  print_r($_GET, true);
	$str .= "<br>SERVER VARS:<br>" .   print_r($_SERVER, true);
	$str .= "<br>FILE VARS:<br>" .  print_r($_FILES, true);
	$str .= "<br>COOKIE VARS:<br>" .  print_r($_COOKIE, true);
	$str .= "<br>REQUEST VARS:<br>" .  print_r($_REQUEST, true);
	$str .= "<br>ENV VARS:<br>" .  print_r($_ENV, true);

	// Only include the SESSION super global if the site is using sessions
	if(isset($_SESSION)){
		$str .= "<br>SESSION VARS:<br>" .  print_r($_SESSION, true);
	}

	return $str;
}

function sendEmail($to, $subject, $msg){
	// TODO send an email, but we can't from xampp!
	echo("<h3>Fake sending email</h3>");
	echo("<b>TO:</b>$to<br>");
	echo("<b>SUBJECT</b>$subject<br>");
	echo("<b>MESSAGE:</b><br>$msg<br>");
}




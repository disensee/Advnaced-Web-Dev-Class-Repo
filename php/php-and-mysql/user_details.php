<?php

$user_id = 0;

if(isset($_GET['user_id'])){
	//echo($_GET['user_id']);
	$user_id = $_GET['user_id'];
}else{
	die("invalid query string, must have a user_id");
}

// set up some vars that will be used to connect to the database
// NOTE: if you are working on QTH, then you'll have to create a user account
$host = "localhost";
$db = "user_test_db";
$user = "root";
$password = "";

// get a 'link' to the database in the MySQL server
// (you might call this a 'connection' in other languages)
$link = mysqli_connect($host, $user, $password, $db);

if(!$link){
	// You wouldn't want to do this in production....
	die(mysqli_connect_error());
}

//var_dump($link);

// now we have a link to the db, we can run a query
// you shouldn't use SELECT *, instead you should be explicit about the columns
$qStr = "SELECT user_id,user_first_name,user_last_name,user_email,user_password,user_salt,user_role,user_active FROM users WHERE user_id = " . $user_id;
$result = mysqli_query($link, $qStr);
$row = mysqli_fetch_assoc($result);

$row['user_first_name'] = htmlentities($row['user_first_name']);


?>


<form>
	<input type="hidden" name="id" value="<?php echo($row['user_id']); ?>" /><br>
	First Name: <input type="text" name="user_first_name" value="<?php echo($row['user_first_name']); ?>" /><br>
	Last Name: <input type="text" name="user_last_name" value="<?php echo($row['user_last_name']); ?>" /><br>
	Email: <input type="text" name="user_email" value="<?php echo($row['user_email']); ?>" /><br>
	Password: <input type="password" name="user_password" value="<?php echo($row['user_password']); ?>" /><br>
	Role: <input type="text" name="user_role" value="<?php echo($row['user_role']); ?>" /><br>
	Active: <input type="text" name="user_active" value="<?php echo($row['user_active']); ?>" /><br>
</form>
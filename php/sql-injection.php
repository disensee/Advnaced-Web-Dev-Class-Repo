<?php
/*

// STEP 1 - Set up the database

1. Start MySQL in XAMPP control panel
2. Goto this link: http://localhost/phpmyadmin/
3. Create a new database on the MySQL server and call it 'sql_injection_db'
4. Note that in the getLink() function at the bottom of the page, the code uses the 'root' user and '' password. 
   If your installation of XAMPP is different, then you may have to update the user name and password used to connect to the db.
5. In sql_injection_db, run this query:


DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
  user_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_first_name varchar(30) NOT NULL,
  user_last_name varchar(30) NOT NULL,
  user_email varchar(255) NOT NULL,
  user_password char(32) NOT NULL
)


6. Insert some rows:

INSERT INTO users (user_first_name,user_last_name, user_email, user_password) VALUES 
('John', 'Doe','john@doe.com', 'opensesame'),
('Jane', 'Doe','jane@doe.com', 'letmein'),
('Bob', 'Smith','bob@smith.com', 'test');

*/

// STEP 2 - create a function to get a link to the database
function getLink(){
	$host = "localhost";
	$db = "sql_injection_db";
	$user = "root";
	$password = "";

	$link = mysqli_connect($host, $user, $password, $db);
	if(!$link){
		die(mysqli_connect_error());
	}
	return $link;
}

$link = getLink();


// STEP 3 - Handle the form post 
// and run a query to get the user from the db that matches the email address entered 
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$email = $_POST['email'] ?? "";
	//$email = mysqli_real_escape_string($link, $email); //this is the function that prevents SQL injection 
	//It scrubs anything that is concatenated into $qStr
	$qStr = "SELECT * FROM users WHERE user_email = '$email'";
	//die($qStr);
	$result = mysqli_query($link, $qStr);
	if($result){
		echo("<h3>HERE IS THE DATA FOR THE USER:</h3>");
		var_dump(mysqli_fetch_all($result, MYSQLI_ASSOC));
	}else{
		die(mysqli_error($link));
	}
}

// STEP 4 - try it out


// STEP 5  - Uncomment the HTML below, it will show you how SQL injection attacks work

// STEP 6 - Prevent the attack by scrubbing the data with mysqli_real_escape_string()

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="POST">
	Enter the email address of a user:
	<input type="text" name="email">
	<br>
	<input type="submit" value="SAVE">
</form>


<h3>SQL Injection Attacks</h3>
<ol>
	<li>Set up the test database (see the comments in the PHP code)</li>
	<li>
		Enter this into the form and submit it (this is how the form is intended to work):
		<br><br>
		<b>bob@smith.com</b>
		<br><br>
	</li>
	<li>
		Now enter this into the form and submit it (it's a SQL injection attack!):
		<br><br>
		<b>bob@smith.com' OR '1' = '1</b>
		<br><br>
	</li>
	<li>
		If the hacker doesn't know that bob@smith.com is in the database, he/she might try this: 
		<br><br>
		<b>' OR 1 = '1</b>
	</li>
</ol>
<h3>We should simulate an XSS attack now, so that you can see the difference between them.</h3>
<p>Put some malicious HTML in the database and then post the form.</p>


</body>
</html>

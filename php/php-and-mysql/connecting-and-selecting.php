<?php
/*
If you haven't been using XAMPP, go ahead and install it on a classroom computer (you may want to put it in a folder under your profile)

1. Start MySQL in XAMPP control panel
2. Goto this link: http://localhost/phpmyadmin/
3. Create a new database on the MySQL server and call it 'user_test_db'
4. In user_test_db, run this query:


DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
  user_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_first_name varchar(30) NOT NULL,
  user_last_name varchar(30) NOT NULL,
  user_email varchar(255) NOT NULL,
  user_password char(32) NOT NULL,
  user_salt char(32) NOT NULL,
  user_role enum('admin','user') NOT NULL DEFAULT 'admin',
  user_active enum('yes','no') NOT NULL DEFAULT 'yes'
)


5. Insert some rows:

INSERT INTO users (user_first_name,user_last_name, user_email, user_password, user_salt, user_role, user_active) VALUES 
('John', 'Doe','john@doe.com', 'opensesame', 'xxx', 'admin', 'yes'),
('Jane', 'Doe','jane@doe.com', 'letmein', 'xxx', 'user', 'yes'),
('Bob', 'Smith','bob@smith.com', 'test', 'xxx', 'user', 'yes');
 
*/


// set up some vars that will be used to connect to the database
// NOTE: if you are working on QTH, then you'll have to create a user account to access the db.
// But on your dev site you can use 'root' with no password
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
//die();

// now we have a link to the db, we can run a query
// you shouldn't use SELECT *, instead you should be explicit about the columns
$qStr = "SELECT user_id,user_first_name,user_last_name,user_email,user_password,user_salt,user_role,user_active FROM users";

// run the query and get a result set back
$result = mysqli_query($link, $qStr);

// if result is false then we have a problem
if(!$result){
	// you wouldn't want to do this in production
	die(mysqli_error($link));
	// to test this, put an error in your SQL statement
}

//echo(mysqli_num_rows($result). "<br>");
//var_dump($result);
//die();

// now we can loop through the result set, there are a few ways you might want to do this....


// APPROACH 1 - turn each row into an indexed array
/*
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		var_dump($row);
		echo("<br><br>");
		//note that each row is an indexed array
	}
}else{
	// what do we do if our select statement runs successfully
	// but returns no rows?????
	// I don't know!
}
die();
*/

/*
// APPROACH 2 - turn each row into an associate array (which uses the column names for the keys)
// instead of getting indexed arrays, we can get associative arrays
// that use the column names as keys for each row
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_assoc($result)){
		var_dump($row);
		echo("<br><br>");
	}
}
*/



// APPROACH 3 - Copy the contents of the data set into a new array.
// this approach may look like overkill, but it allow you
// to 'disinfect' the data if necessary
// We'll infect the data in a minute

$users = array();
if(mysqli_num_rows($result) > 0){
	while($row = mysqli_fetch_array($result)){
		$u = array();
		$u['user_id'] = htmlentities($row['user_id']);
		$u['user_first_name'] = htmlentities($row['user_first_name']);
		$u['user_last_name'] = htmlentities($row['user_last_name']);
		$u['user_email'] = htmlentities($row['user_email']);
		$u['user_password']= htmlentities($row['user_password']);
		$u['user_salt']= htmlentities($row['user_salt']);
		$u['user_role']= htmlentities($row['user_role']);
		$u['user_active'] = htmlentities($row['user_active']);
		$users[] = $u;
	}
}

//echo("dumping users array...<br>");
//var_dump($users);
//die();



// FINALLY, here's how you might display the data on the page
// here's how you could use the data to create a table
echo("<table border=\"1\">");
foreach($users as $u){
	echo("<tr>");
	echo("<td>{$u['user_first_name']}</td>");
	echo("<td>{$u['user_last_name']}</td>");
	echo("<td>{$u['user_email']}</td>");
	echo("<td><a href=\"user_details.php?user_id={$u['user_id']}\">EDIT</a></td>");
	echo("</tr>");
}
echo("</table>");


// nowadays, the data is returned to the client (browser) as JSON
//echo(json_encode($users));



/*
// I used this to do the XXS attack....
$qStr = "update users set user_email = '<script>location.href=\"http://www.yahoo.com\";</script>' where user_id = 2";
//$qStr = "update users set user_email = 'jane@doe.com' where user_id = 2";
$result = mysqli_query($link, $qStr);
if(!$result){
	die(mysqli_error($link));
}
echo(mysqli_affected_rows($link));
var_dump($result);
*/

?>
<?php
/*
To view cookies in FF: Tools > Options > Privacy 
Then click the link to 'Remove Individual Cookies'

Here's an interesting article about the default cookie settings for
browsers:
https://riseup.net/en/security/network-security/better-web-browsing/browser-score-card
*/

// To get cookie from the request 
//(you should make sure it exists first by using isset()):
$first_name = "";

if(isset($_COOKIE['fName'])){
	$first_name = $_COOKIE['fName'];
}
echo("<h3>Hello $first_name!</h3>");



// Use cookies to track page visits (count the number of times a user has visited this page)
$visits = 1; // assume that this is the first visit to the page

if(isset($_COOKIE['page-counter'])){
	// If the page-counter cookie has been set then use it to update $visits
	$visits = $_COOKIE['page-counter'];
	if(is_numeric($visits)){
		$visits += 1; 
	}
}

// now reset the cookie with the new number of visits
setcookie("page-counter",$visits, time() + (60 * 60 * 24 * 365));

echo("Number of visits: {$visits}");


// to delete a cookie
setcookie("fName","", time() - 1);
echo("<br>I just deleted the 'fName' cookie!");

?>
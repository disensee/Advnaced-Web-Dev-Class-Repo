<?php
$someVar = "BAR";

echo("FOO $someVar <br>");


$person = ['first_name' => 'Chris', 'last_name' => 'Mc Alister'];
//echo("Hello $person['first_name'] <br>"); //THIS WONT WORK
echo("Hello {$person['first_name']}<br>"); // But this will work

$people = array();
$people[] =	array('first_name' => "Bob", 'last_name' => "Smith");
$people[] =	array('first_name' => "Sara", 'last_name' => "Jones");
$people[] =	array('first_name' => "Lisa", 'last_name' => "Thompson");

echo("<ol>");

foreach ($people as $p) {
	echo("<li> {$p['first_name']} {$p['last_name']}</li>");
}

echo("</ol>");
?>
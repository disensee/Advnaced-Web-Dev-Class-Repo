<!DOCTYPE html>
<html>
<head>
	<title>OO PHP - Step 1</title>
</head>
<body>
<?php

include("User.inc.php"); // this is like importing in Java
include("App.inc.php"); //DON"T FORGET TO INCLUDE THE CLASS!

//create two user objects
$user1 = new User("Bob", "Smith");
$user2 = new User("Sally", "Jones");

//invoke a method of each object
$user1->sayHello();
$user2->sayHello();

//create our App object
$app = new App();
$app->addUser($user1);
$app->addUser($user2);

$app->showUsers();

?>

<h3>Pre-Reqs</h3>
<ul>
	<li>Basic understanding of PHP</li>
	<li>
	Basic understanding of OO programming, includeing: 
	<ol>
		<li>classes</li>
		<li>objects</li>
		<li>constructor functions</li>
	</li>
</ul>

<h3>Follow Up Questions</h3>
<ul>
	<li>What is <b>procedural</b> programming?</li>
	<li>How do you define a constructor function in a class (in PHP)?</li>
	<li>Why is it that we normally don't use ?&gt; at the end of an include file?</li>
	<li>What is <b>client code</b>?</li>
	<li>
		Java, C#, and JavaScript use the <b>dot operator</b> to invoke methods of objects.
		What does PHP use instead of the dot operator?
	</li>
</ul>

<h3>Introduction</h3>
<p>
	PHP is both a <b>procedural language</b> and an <b>object-oriented language</b>
	Just about all the code samples from the book for this course use procedural PHP.
	And the first few steps of our <b>my-new-site</b> project follow this approach as well.
	But we can also create classes in PHP, and that really helps us to organize our code.
</p>
<p>
	I have a confession to make, it was a big struggle for me to keep adding functions to our config file in the 'my-new-site' project!
	This is a procedural approach (a bunch of functions, rather than objects that contain methods).
	I much prefer to organize my code into classes.
	In fact, my website has only one php file that is not a class (index.php).
</p>
<p>
	Many beginning books on PHP ignore classes, and instead teach the procedural approach.
	I believe that this is done because the authors don't assume that you know anything about object-oriented programming.
	But you have all been through Java, and C#, so you should understand
</p>


<h3>Assignment - Part 1</h3>
<ol>
	<li>
		Create a file (in the step1 folder) called <b>User.inc.php</b>.
		The file name starts with a capital letter, which is meant to indicate that it is a class.
	</li>
	<li>
		<p>
			Add <a href="user-class.png">this</a> code to the page.
			But before you start typing in the code, read the next few notes:
		</p>
		<ul>
			<li>
				<p>
					<b>Be careful with the dollar signs!</b> 
					If you are still relatively new to PHP, you probably forget them a lot.
					But be extra careful with this example, the dollar signs may seem to be in extra strange places
					(more on that in a minute).
				</p>
			</li>
			<li>
				<p>
					Classes are usually defined in their own include file (hence the file name User.inc.php)
					They are not 'stand-alone' web pages that are meant to be displayed in the browser,
					rather they are components that are 'included' in PHP web pages.
				</p>
			</li>
			<li>
				<p>
					Note that PHP does not use the <b>dot operator</b>, instead it uses what some people call
					the <b>skinny arrow</b>, which is a dash followed by the greater than sign.
					This may look very strange to you unless you have done some C programming.
				</p>
			</li>
			<li>
				<p>
					Note that to define a constructor function you use <b>__construct()</b>.
					In older versions of PHP you could write a constructor function like the one below, but 
					it is now deprecated (I'm not sure why they did that):
				</p>
				<pre>
// this approach to create a constructor doesn't work in PHP 7...

function User($firstName, $lastName){
	$this->firstName = $firstName;
	$this->lastName = $lastName;
}

// This is how you must define constructor functions in PHP 7...
function __construct($firstName, $lastName){
	$this->firstName = $firstName;
	$this->lastName = $lastName;
}
				</pre>
			</li>
			<li>
				<p>
					By the way, when a function name starts with two underscores in PHP, it's known as a 'magic' function.
					For more information on that, check out <a href="http://php.net/manual/en/language.oop5.magic.php" target="_">this</a> link.
				</p>
			</li>
			<li>
				<p>
					Note that when you use 'this' to access an instance variable,
					you put the dollar sign before 'this'. Kinda strange!
				</p>
			</li>
			<li>
				<p>
					Finally, include files don't need the closing php delimiter: <b>?&gt;</b>.
					Notice that it's not in the screen shot of the User.inc.php file.
					If you did put <b>?&gt;</b> at the bottom of the page, and then had some return carriages (or spaces) after that line,
					then the return carriages would get sent as output to the browser.
					This could potentially cause some problems.
					For example, assume that we did put the closing php delimiter at the end of User.inc.php.
					And that you had some return carriages after that.
					If we used include() in this page to link to User.inc.php, and then tried to send a header (by calling the header() function),
					the page could err out. This is because in HTTP, headers must be sent before any content is sent (spaces and line breaks are considered content).
					For more info, check out <a href="https://stackoverflow.com/questions/8028957/how-to-fix-headers-already-sent-error-in-php" target="_blank">this</a> link.
				</p>
			</li>
		</ul>
	</li>
	<li>
		<p>
		At the top of this file (index.php) you'll see a block of PHP code.
		It simply echos 'Put your PHP client code here!'.
		Replace the echo statement with <a href="create-2-users.png">this</a> code.
		</p>
		<p>
			Reload this page in the browser.
			If you get any errors, make sure you didn't forget to use a dollar sign somewhere in User.inc.php
		</p>
		Note that the code in this page is <b>client code</b>. 
		It is the code that makes use of our User class.
	</li>
</ol>

<h3>Assignment - Part 2</h3>
<ol>
	<li>Create another file in this folder and call it <b>App.inc.php</b></li>
	<li>Put <a href="app-class.png">this</a> code in the file.</li>
	<li>Now update the PHP code in this page (index.php) to look like <a href="use-app-class.png">this</a>.</li>
	<li>
		Reload this page in the browser.
		Can you understand why it's not working?
	</li>
	<li>Go ahead and fix the problem.</li>
</ol>

</body>
</html>

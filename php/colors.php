<?php
$colors = array("red", "blue", "green", "purple", "yellow", "orange");

/*
Step 1
Create a PHP function that does the following...
	- Has a parameter, which should be an array of strings
	- Returns a string of html OPTION elements, one for each string in the array.
	  In other words, 'wrap' each string from the array in an option element.
  
When the function is complete, use it (invoke it) to populate the select box in the FORM element below.
Use the $colors variable as the parameter/argument.


Step 2 - Add a second parameter to the function which will indicate which option should default to being selected.
For example, if you pass in 'blue' for this second parameter, then the option containing 'blue' should default to being the selected option.
*/
function some_function($str_array, $default){
	foreach($str_array as $s){
		if($default == $s){
			echo("<option selected = \"$default\">$s</option>");
		}else{
			echo("<option>$s</option>");
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Data Driven Select Boxes (Using PHP)</h1>
	<p>
		
	</p>
	<br><br>
	<form id="frmColors" action="http://www.wtc-web.com/form-handler.php" method="POST">
		<label for="txtName">Your Name:</label>
		<input type="text" id="txtName" name="name">
		<br>
		<label for="selColors">Your Favorite Color:</label>
		<select id="selColors" name="favoriteColor">
		<?php some_function($colors, "blue"); ?>
		</select>
		<br>
		<input type="submit" name="btnSubmit" value="Send to Server">
	</form>
</body>
</html>
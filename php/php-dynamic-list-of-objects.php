<?php
$data = [
	array("id" => 101, "firstName" => "Bob", "lastName" => "Smith", "department" => "Sales"),
	array("id" => 102, "firstName" => "Sally", "lastName" => "Jones", "department" => "IT"),
	array("id" => 105, "firstName" => "Jim", "lastName" => "Johnson", "department" => "Accounting"),
	array("id" => 98, "firstName" => "Clair", "lastName" => "Jones", "department" => "Sales")
];

// Problem 1
$html_list = create_employee_list($data);
echo($html_list); //$html_list gets echoed below (in the right place)


function create_employee_list($employees){
	// create a string of html that can be embedded on the page
	// start the string off by initializing it to an opening OL tag
	// loop through the $employees parameter and add to the string an LI element
	// that displays the first and last name of each employee
	// after the loop, add a closing OL tag to the string.
	// return the string

	$html_str = "<ol>";
	foreach($employees as $key => $value){
		
	}
	

	


// Problem 2
// Use this function in the body of the create_employee_list function to turn the list into a list of links
function create_employee_link($employee){
	$url = "this-page.php?empId=" . $employee["id"];
	$employeeName = $employee['firstName'] . " " . $employee['lastName'];
	return "<a href=\"$url\">$employeeName</a>";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP Search Employee Data Set</title>
</head>
<body>
	<div id="list-container">
		<!-- <?php echo($html_list); ?> -->
	</div>
</body>
</html>
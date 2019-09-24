<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	//var_dump($_POST);

	//THIS WILL CRASH IF CHECK BOX IS NOT CHECKED	
	//$agree = $_POST['agreeToTerms'];
	//echo($agree);

	//APPROACH 1 -- if statement
	/*
	$agree = null;
	if(isset($_POST['agreeToTerms'])){
		$agree = $_POST['agreeToTerms'];
	}else{
		$agree = 'no';
	}

	echo($agree);
	*/

	//APPROACH 2 - conditional operator
	//$agree = isset($_POST['agreeToTerms']) ? $_POST['agreeToTerms'] : "no";
	//echo($agree);

	//APPROACH 3 - null coalescing operator
	$agree = $_POST['agreeToTerms'] ?? "no";
	echo($agree);
}
?>
<form method="POST">
	Agree to our terms:
	<input type="checkbox" name="agreeToTerms" value="yes">
	<input type="submit">
</form>
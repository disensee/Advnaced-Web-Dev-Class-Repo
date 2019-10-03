<?php
/*
STEPS - somebody please make sure I don't miss a step!
1. Load this page in the browser and observe the different errors by uncommenting troublesome code
2. Uncomment the link the the include file (config.inc.php)
3. Look at the code in config.inc.php
4. Run the code again and experiment with it.
5. MAKE SURE TO SEE WHAT HAPPENS WHEN YOU SET DEBUG MODE TO TRUE FOR LOCALHOST!
6. Uncomment the try/catch block in convert_date()
	You can rethrow and exception and allow the client code to handl it in a way that suits it
*/
include("config.inc.php"); // leave this commented out for the first step



// START HERE...
echo($blah);// Note that this causes an ERROR not an EXCEPTION

// certain syntax errors ('parse errors') will not trigger your custom error handler! WEIRD
//echo("hello")
//echo("world");

// this is how convert_date() is supposed to be used
//echo(convert_date("12/31/2018"));

// this will cause a problem
//echo(convert_date("12/31\2018")); // UNCAUGHT EXCEPTION


// If you are aware that a method/function could throw an exception
// you could wrap it in a try catch block
try{
	echo(convert_date("12/31\2018"));
}catch(Exception $e){
	//echo("What do we do now?");
	var_dump($e);
}


function convert_date($dateStr){
	//try{
		$dt = new DateTime($dateStr);
		return $dt->format('Y-m-d');
	//}catch(Exception $e){
	//  return ""; // or return false? Note sure
		// or rethrow it 	
	//	throw new Exception("convert_date() - Unable to convert string to date", 1);
	//}
}



?>
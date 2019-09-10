<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">

    <title>PHP Basics</title>

    
    <link REL=StyleSheet HREF="css/style.css" TYPE="text/css">
  </head>
  <body>
    
  <h1>HELLO WORLD!</h1>
  <br>
  <?php
  $foo = "bar";
  echo($foo);
    // PHP is a 'server-side' language, which means it runs on the web server
    // Remeber that JavaScript code runs on the client (the browser)
    // This means that you must have a web server running for php pages to work.
    // The results of the PHP code are sent to the client in the HTTP response
    // So we basically use PHP to generate HTML
    // Why do we need both server side and client side code?


    // STEP 1 - COMMENTS
    // Mention the php delimiter <?php
    // Show a web page that has html and php mixed into it - WordPress!
    // comments
    
    /*
    This is a 
    multi-line
    comment
    */

    # this is also a comment
  
    
    
    // STEP 2 - The results of PHP code is what get's sent to the browser
    // Show today's date
    



    
    // STEP 3 - Showing errors
    // turning on debugging:
    // WHY would you want to turn off debugging?
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    //x = "foo";

    
    // STEP 4 - Generating HTML with PHP code
    // Output some HTML
    echo ("<h3>Foo</h3>");
    $today = new DateTime();
    echo($today->format('m/d/Y'));

    

    // STEP 5 - Spagetti Code
    // Note that PHP code is often mixed with HTML code
    //it's very common in php to see spagetti code



    
    // STEP 6 - Variables
    // Create a variable - variable names start with $
    // they normally use all lower case letters, and words
    // are separated by underscores
    // You don't need to specify a data type when you declare a variable
    // (php is 'loosely typed') and php will try to handle type conversions for you
    $my_var = "Bob";
    $my_other_var = "Smith";

    // STEP 7 - String Concatenation
    // Concatenate some strings...
    echo("<br>" . $my_var . " " .$my_other_var);
 
    // STEP 8 - Constants
    // Define a Constant
    // note that constant names dont use $
    // also note that constants are global in scope
    // also note that constants can only hold 'scalar' data
    define("PI", 3.14);
    echo("<br>" . PI);


    // STEP 9 - Escaping Strings
    // Escaping quotes so that you can use them in a string
    $some_var = "He said \"Hi\".";
    echo("<br>" . $some_var);

    
    // STEP 10 - Variable Interpolation
    // There is a difference between using single quotes and double quotes
    // If you use double quotes you can mix variables into your string and their
    // values will be displayed
    $some_var = "blah";
    echo("<br>" . "some_var is set to: $some_var");
    echo("<br>" . 'some_var is set to: $some_var');

    // STEP 11 - Conditionals and Logical Operators
    // Conditionals (IF ELSE)
    // and operators  && and ||
    $rich = true;
    $famous = false;
    if($rich && $famous){
      echo("<br><h3>Congrats!!!</h3>");
    }else{
      echo("<br><h3>Hopefully you are either rich OR famous.</h3>");
    }


    // STEP 12 - Built-in Functions
    // There are TONS of built-in functions in PHP
    // the strpos() function
    echo("<br>" . strpos("hello world", "w"));

    // The empty() function
    $x = "";
    if(empty($x)){
      echo("<br>It's empty.");
    }


    // AND MANY, MORE FUNCTIONS THAT SAVE YOU LOTS OF CODING







    
    // GLOBAL VARIABLES
    // Php has global variables that are similar to global variables in JavaScript
    // (global variables declared in one .php file are visible in other .php files that are referenced in your script)
    // BUT, in order to use a global variable from within a function, it must be 
    // 're-declared' inside the function body, preceded by the 'global' keyword.
    $some_global = "foo";

    function some_function(){
      global $some_global; //global variable declared inside the function

      $some_local = "bar";
      echo("<br>" . $some_global);
    }
    
    some_function();
  ?>


 

  </body>
</html>

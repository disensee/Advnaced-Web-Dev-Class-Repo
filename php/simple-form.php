<?php

$first_name = "";
$last_name = "";
$pizza_toppings = array();

$validation_errors = array();

//echo($_SERVER['REQUEST_METHOD']);
if($_SERVER['REQUEST_METHOD'] == "POST"){
  //var_dump($_POST);
  //STEP 1 - Get the user input that was posted
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  
  if(isset($_POST['pizza_toppings'])){
    $pizza_toppings = $_POST['pizza_toppings'];
  }
  //STEP 2 - Validate the user input
  //If we find a problem with something
  //we'lll add it to the validation_errors array

  if(empty($first_name)){
    $validation_errors['first_name'] = "Please enter your first name";
  }

  if(empty($last_name)){
    $validation_errors['last_name'] = "Please enter your last name";
  }

  if(empty($pizza_toppings)){
    $validation_errors['pizza_toppings'] = "Please choose at least one topping";
  }

  //STEP 3 - If there are no validation error messages then we can process the data
  if(empty($validation_errors)){
    echo("Thanks, we are processing your data!");
    die();
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <title>Posting Forms</title>
  </head>
  <body>
  <h1>Posting Forms</h1>
  <br>

  <form method="POST" action="simple-form.php" >
      FIRST NAME:
      <br> 
      <input type="text" name="first_name"/>
      <?php 
      if(isset($validation_errors['first_name'])){
        echo($validation_errors['first_name']);
      }
      ?>
      <br>
      LAST NAME:
      <br>
      <input type="text" name="last_name"/>
      <?php 
      if(isset($validation_errors['last_name'])){
        echo($validation_errors['last_name']);
      }
      ?>
      <br>
      <br>
       WHAT DO YOU LIKE ON YOUR PIZZA?
       <?php 
      if(isset($validation_errors['pizza_toppings'])){
        echo($validation_errors['pizza_toppings']);
      }
      ?>
      <br>
      <input type="checkbox" name="pizza_toppings[]" value="sausage" /> Sausage
      <br>
      <input type="checkbox" name="pizza_toppings[]" value="pepperoni" /> Pepperoni
      <br>
      <input type="checkbox" name="pizza_toppings[]" value="mushrooms" /> Mushrooms
      <br>
      <br>
      <input type="submit" name="btn_submit" value="Submit" />
  </form>

  </body>
</html>

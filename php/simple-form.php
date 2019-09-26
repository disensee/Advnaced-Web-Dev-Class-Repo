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
  
  //if(isset($_POST['pizza_toppings'])){
  //  $pizza_toppings = $_POST['pizza_toppings'];
  //}

  //SHORTCUT FOR ABOVE IF STATEMENT
    $pizza_toppings = $_POST['pizza_toppings'] ?? $pizza_toppings;

  //STEP 2 - Validate the user input
  //If we find a problem with something
  //we'lll add it to the validation_errors array

  if(empty($first_name)){
    $validation_errors['first_name'] = wrap_err_msg("Please enter your first name");
  }

  if(empty($last_name)){
    $validation_errors['last_name'] = wrap_err_msg("Please enter your last name");
  }

  if(empty($pizza_toppings)){
    $validation_errors['pizza_toppings'] = wrap_err_msg("Please choose at least one topping");
  }

  //STEP 3 - If there are no validation error messages then we can process the data
  if(empty($validation_errors)){
    echo("Thanks, we are processing your data!");
    die();
  }
}

function wrap_err_msg($msg){
  return "<span class=\"validation\">$msg</span>";
}

function isChecked($chkName, $value){
  if(!empty($_POST[$chkName])){
    foreach($_POST[$chkName] as $chkValue){
      if($chkValue == $value){
        return true;
      }
    }
  }
  return false;
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
    <style>
    .validation{color:red;}
    </style>
  </head>
  <body>
  <h1>Posting Forms</h1>
  <br>

  <form method="POST" action="simple-form.php" >
      FIRST NAME:
      <br> 
      <input type="text" name="first_name" value = "<?php echo($first_name); ?>"/>
      <?php 
      //if(isset($validation_errors['first_name'])){
      //  echo($validation_errors['first_name']);
      //}
      echo($validation_errors['first_name'] ?? "");
      ?>
      <br>
      LAST NAME:
      <br>
      <input type="text" name="last_name" value="<?php echo($last_name); ?>"/>
      <?php 
      //if(isset($validation_errors['last_name'])){
      //  echo($validation_errors['last_name']);
      //}
      echo($validation_errors['last_name'] ?? "");
      ?>
      <br>
      <br>
       WHAT DO YOU LIKE ON YOUR PIZZA?
       <?php 
      //if(isset($validation_errors['pizza_toppings'])){
      //  echo($validation_errors['pizza_toppings']);
      //}
      
      echo($validation_errors['pizza_toppings'] ?? "");
      ?>
      <br>
      <input type="checkbox" name="pizza_toppings[]" value="sausage" 
      <?php
      //MY WAY
      if(isChecked('pizza_toppings', 'sausage')){
        echo("checked");
      }
      
      //NIALLS WAY
      //echo(in_array("sausage", $pizza_toppings) ? "checked" : "");
      ?>
      /> Sausage
      <br>
      <input type="checkbox" name="pizza_toppings[]" value="pepperoni" 
      <?php
      //MY WAY
      if(isChecked('pizza_toppings', 'pepperoni')){
        echo("checked");
      }
      
      //NIALLS WAY
      //echo(in_array("pepperoni", $pizza_toppings) ? "checked" : "");
      ?>/> Pepperoni
      <br>
      <input type="checkbox" name="pizza_toppings[]" value="mushrooms" 
      <?php
      //MY WAY
      if(isChecked('pizza_toppings', 'mushrooms')){
        echo("checked");
      }
      
      //NIALLS WAY
      //echo(in_array("mushrooms", $pizza_toppings) ? "checked" : "");
      ?>/> Mushrooms
      <br>
      <br>
      <input type="submit" name="btn_submit" value="Submit" />
  </form>

  </body>
</html>

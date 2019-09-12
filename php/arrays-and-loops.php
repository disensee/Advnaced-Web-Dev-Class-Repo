<?php

// there are two types of arrays in php:
// Associative and Indexed

// create an INDEXED array
$ar1 = array();
$ar1[] = "hello";
$ar1[] = "world";
$ar1[2] = "!!!!";
// dump out the array
var_dump($ar1);
// echo out the first element in the array
echo ("<br>" . $ar1[0]);
// add an element to an array
$ar1[] = "foo";
$ar1[4] = "bar";
echo("<br>");
var_dump($ar1);
//var_dump($ar1);
// change an element in an array
$ar1[0] = "goodbye";
echo("<br>" . $ar1[0]);
// populate an array by adding params to the array() method
$ar2 = array("foo", "bar");
echo("<br>");
var_dump($ar2);
// ASSOCIATIVE ARRAYS - USE STRINGS FOR THE INDEX (KEY VALUE PAIRS)
// Let's create an associative array...
$ar3 = array();
$ar3["name"] = "Bob";
$ar3["age"] = 27;
$ar3["likes-pizza"] = true;
$ar3["gender"] = "male";
// Dump out $ar3
echo("<br>");
var_dump($ar3);
echo("<br>");
echo($ar3["gender"]);
// Another way to create and ASSOCIATIVE array:
$ar4 = array(
    "key1" => "value1",
    "key2" => "value2"
);
echo("<br>");
var_dump($ar4);

// loop through an array
foreach($ar1 as $e){
    echo("<br>$e");
}
// loop through an associative array
foreach($ar4 as $e){
    echo("<br>$e");
}

foreach ($ar3 as $key => $value) {
    echo("<br>KEY:$key VALUE: $value");
}
// multi-deminsional array
$ar5 = array(
    array(1,2,3),
    array(4,5,6)
);
// another way to creat a multi-dimensional array
$rows = array();
$rows[] = array("Bob", "Smith", 27, "male");
$rows[] = array("Sally", "Jones", 37, "female");
// For loop using count() function
for ($x=0; $x < count($ar1); $x++) { 
    echo("<br>" . $ar1[$x]);
}
// check to see if a variable is an array with is_array()
if(is_array($ar1)){
    echo("<br>It's an array!!! Hooray!!!");
}
// the implode() function
echo("<br>" . implode($ar1));
// the explode() function
$some_str = "Bob, Sally, Betty";
$ar6 = explode(",", $some_str);
echo("<br>");
var_dump($ar6);
?>
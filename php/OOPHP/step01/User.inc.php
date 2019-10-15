<?php

class User{
    private $firstName;
    private $lastName;

    public function __construct($firstName, $lastName){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function sayHello(){
        echo("Hello, I'm " . $this->firstName . "<br>");
    }

    public function getFirstName(){
        return $this->firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }
}
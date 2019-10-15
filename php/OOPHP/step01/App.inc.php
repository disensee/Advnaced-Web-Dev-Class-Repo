<?php

class App{
    private $users = array();

    function addUser($u){
        $this->users[] = $u;
        //remember that in PHP elements can be added to an array using []
    }

    function showUsers(){
        echo("<h3>Here are the users in this system</h3>");
        echo("<ol>");

        foreach($this->users as $u){
            echo("<li>" . $u->getFirstName() . " " . $u->getLastName() . "</li>");
        }

        echo("</ol>");
    }
}
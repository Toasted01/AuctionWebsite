<?php

require_once("Models/User.php");

if (isset($_POST["signupButton"])) {//checks to see if the sign up button has been pressed
    $user = new User();
    if($user->checkUser($_POST["NewUname"])) {//checks to see if the name imputed by the user already appears in the database
        $user->addUser($_POST["NewUname"],sha1($_POST["NewPass"]));//adds the user to the database
    }
    else{
        echo "Username taken";
    }
}

require_once('views/signup.phtml');
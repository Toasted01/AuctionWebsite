<?php

require_once("Models/User.php");

$view = new stdClass();
$view->loggedin = "not logged in";

if (isset($_POST["loginButton"])) {//checks to see if the login button is pressed
    $user = new User();
    if($user->Authenticate(($_POST["Uname"]),($_POST["Pass"]))) {//checks that the username and password are correct
        $_SESSION["loggedin"] = true; //logs in the user
        echo "<p>User is logged in</p>";
    }
    else{
        $_SESSION["loggedin"] = false;
        if ($view->loggedin = "not logged in") {
            echo "<p>Username or password is incorrect</p>";
        }
    }
}

if (isset($_POST["logoutButton"])) {//checks to see if the logout button has been pressed
    $user = new User();
    $user->logout();//logs out the user
    $view->loggedin = "not logged in";
}

if (isset($_SESSION["loggedin"]))
{
    $view->loggedin = "logged in";//tells view the user is logged in
}

require_once('views/login.phtml');
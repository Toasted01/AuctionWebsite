<?php

require_once("DataSet.php");
require_once ("AuctionDataSet.php");

class User
{
    protected $_user, $_loggedIn, $_userID, $_Admin;

    public function __construct()
    {
        session_start();//starts session with non-logged in variables

        $this->_user = "No user";
        $this->_loggedIn = false;
        $this->_userID = "0";
        $this->_Admin = false;

        $_SESSION["userID"]=0;
        $_SESSION["login"] = "No user";

        if (isset($_SESSION["login"]))
        {
            $this->_user = $_SESSION["login"];
            $this->_userID = $_SESSION["userID"];
            $this->_loggedIn = true;
            $this->_Admin = false;
        }
    }

    public function Authenticate($_user, $password)
    {
        $users = new DataSet();
        $row = $users->authenticate($_user, sha1($password));//runs the authenticate query
        $userDataSet[] = new Data($row);//puts the data into an array

        //if there is no user with the imputed name the function returns an empty string which is why i cant use count to see if there is a record or not because there will always be one.
        if ($userDataSet[0]->getUserID() == "")
        {
            $this->_loggedIn = false;
            return false;
        } else {//sets session variables to logged in state
            $_SESSION["login"] = $_user;
            $_SESSION["userID"] = $userDataSet[0]->getUserID();
            $this->_loggedIn = true;
            $this->_user = $_user;
            $this->_userID = $userDataSet[0]->getUserID();
            return true;

        }
    }

    public function checkUser($_user)//checks to see if the username appears in the database
    {
        $name = new DataSet();
        $nameDataSet[] = $name->checkName($_user);//runs the checkName query

        if ($nameDataSet[0] == "")//checks for an empty string
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function addUser($name, $pass)//adds a user to the database
    {
        $newUser = new DataSet();
        $idDataSet = $newUser->newUser();//runs the newUser query to get the last id
        $idData = new Data($idDataSet); //creates a data object using $idDataSet
        $newId = $idData->getUserID() + 1;// finds the last user id and adds 1 to it for the new id
        $newUser->addUser($newId, $name, $pass);//adds the user
    }

    public function isLoggedIn()//gets the variable _loggedIn
    {
        return $this->_loggedIn;
    }

    public function getUser()//gets the variable _user
    {
        return $this->_user;
    }

    public function getID()//gets the variable _userID
    {
        return $this->_userID;
    }

    public function isAdmin()//gets the variable _Admin
    {
        return $this->_Admin;
    }

    public function logout()//logs out of the session
    {
        //resets fields
        $this->_loggedIn = false;
        $this->_userID = "0";
        $this->_user = "No user";
        session_unset();//unsets the session fields
    }
}
<?php

require_once ('Database.php');
require_once ('Data.php');

class DataSet {
    protected $_dbHandle, $_dbInstance;
        
    public function __construct() {//loads the database
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function authenticate($_user, $password ) {
        $statement = $this->_dbHandle->prepare("SELECT * FROM aee513.Users WHERE Username = ? AND Password = ?");//finds any records that have the imputed username and password
        //sql injection blocking
        $statement->bindParam(1, $_user);
        $statement->bindParam(2, $password);
        $statement->execute();//runs the query

        return $statement->fetch();//returns the records
    }

    public function checkName($_user) {
        $statement = $this->_dbHandle->prepare("SELECT Username FROM aee513.Users WHERE Username = ?");//selects all records that match the username imputed
        //sql injection blocking
        $statement->bindParam(1, $_user);
        $statement->execute();//runs the query

        return $statement->fetch();//returns the records
    }

    public function newUser() {
        $statement = $this->_dbHandle->prepare("SELECT * FROM aee513.Users ORDER BY UsersId DESC LIMIT 1");//selects the last user by id
        $statement->execute();//runs the query
        return $statement->fetch();//returns the records
    }

    public function addUser($newId, $name, $pass) {
        $statement = $this->_dbHandle->prepare("INSERT INTO aee513.Users (UsersId, Username, Password, IsAdmin) VALUES ($newId,?,?,false);");// adds a new non admin user using the imputed fields
        //sql injection blocking
        $statement->bindParam(1, $name);
        $statement->bindParam(2, $pass);
        $statement->execute();//runs the query
    }
}



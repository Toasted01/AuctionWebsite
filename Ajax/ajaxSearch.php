<?php

require_once('../Models/AuctionDataSet.php');

$auctionDataSet = new AuctionDataSet();
$auctionDataSet = $auctionDataSet ->getTaskName($_GET["q"]);//uses the name sent from the search box to get the all the auctions that are like what you typed in

session_start();

$token="";
if (isset($_SESSION["ajaxToken"])){//checks to see if an ajaxToken is in the session
    $token = $_SESSION["ajaxToken"];//sets token to be the ajax token
}

if (!isset($_GET["token"]) || $_GET["token"] != $token){ //checks to se if the token is set and correct
    //does not allow any data through
    $data = new stdClass();
    $data->error = "No data :)";
    echo json_encode($data);
}
else{//allows the data through
    echo json_encode($auctionDataSet);
}
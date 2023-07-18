<?php

require_once('../Models/AuctionDataSet.php');

$auctionDataSet = new AuctionDataSet();
$auctionDataSet = $auctionDataSet ->getAuctions($_GET["q"]);//uses the id sent from the item.phtml file to get the auction details of the lot

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
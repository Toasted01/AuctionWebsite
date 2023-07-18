<?php
require_once('Models/AuctionDataSet.php');
require_once("Models/User.php");
session_start();
$_SESSION["ThisItem"]=0;

if (isset($_POST["ViewButton"])) {
    $_SESSION["ThisItem"]=$_POST["AuctionId"]+1;//gets the id of the item from auction.php you clicked
    echo $_SESSION["ThisItem"];
    header('Location: item.php');
    exit();
}

require_once('views/auction.phtml');
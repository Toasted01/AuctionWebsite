<?php
require_once('Models/AuctionDataSet.php');
require_once ("Models/User.php");

session_start();

$view = new stdClass();

if (isset($_POST["searchButton"])) {//checks to see if the search button has been pressed
    $_ADS = new AuctionDataSet();
    $_item = $_ADS->getTaskName($_POST["search"]);
    if($_item == null)
    {
        header("Location: auction.php");//goes back to the auction page
        exit();
    }
    else {
        $_id = $_item[0] -> getID();
        $_SESSION["ThisItem"] = $_id;
    }
}

if (isset($_POST["Bid"])) {//checks to see if the bid button is pressed
    if(@$_SESSION["loggedin"] != null and @$_SESSION["loggedin"] != "") {
        $bidding = new AuctionDataSet();
        if ($_POST["Bid"] > $_POST["oldBid"]) {//checks to see if the new bid is higher than the old bid
            $bidding->bid($_POST["theId"], $_POST["Bid"], $_SESSION["userID"]);// bids on the item
        } else {
            header("Location: auction.php");//goes to the auction table
            echo "<p>Please enter a number higher than the current highest bid</p>";
            exit();
        }
    }
    else {
        echo "<p>You must be logged in to bid</p>";
    }
}

require_once ("views/item.phtml");

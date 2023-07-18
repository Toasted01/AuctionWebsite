<?php

require_once ('Database.php');
require_once ('AuctionData.php');

class AuctionDataSet {
    protected $_dbHandle, $_dbInstance;
        
    public function __construct() {//create the database
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function getAllAuctions() {//gets all the auctions replacing foreign keys with appropriate data
        $statement = $this->_dbHandle->prepare("SELECT Auction.AuctionID, Users.Username, Item.ItemTitle, u2.Username as Bidder, HighestBid, StartDate, EndDate, Images.ImagePath1, Images.ImagePath2, Images.ImagePath3 FROM aee513.Auction INNER JOIN Users on Auction.SellerID=Users.UsersId INNER JOIN Item on Auction.ItemID=Item.ItemId INNER JOIN Images on Auction.ItemID=Images.ItemId INNER JOIN Users u2 on Auction.HighestBidder=u2.UsersId LIMIT 20;");
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {//adds all rows to the array
            $dataSet[] = new AuctionData($row);
        }
        return $dataSet;
    }

    public function getAuctions($id) {//gets the record with the imputed id
        $statement = $this->_dbHandle->prepare("SELECT Auction.AuctionID, Users.Username, Item.ItemTitle, u2.Username as Bidder, HighestBid, StartDate, EndDate, Images.ImagePath1, Images.ImagePath2, Images.ImagePath3 FROM aee513.Auction INNER JOIN Users on Auction.SellerID=Users.UsersId INNER JOIN Item on Auction.ItemID=Item.ItemId INNER JOIN Images on Auction.ItemID=Images.ItemId INNER JOIN Users u2 on Auction.HighestBidder=u2.UsersId WHERE Auction.AuctionID=$id LIMIT 1;");
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new AuctionData($row);
        }
        return $dataSet;
    }

    public function bid($id, $bid, $bidder) {//updates the highest bid on row $id to $bid
        $statement = $this->_dbHandle->prepare("UPDATE Auction SET HighestBid=$bid WHERE AuctionID=$id;");
        $statement->execute();
        $statement = $this->_dbHandle->prepare("UPDATE Auction SET HighestBidder=$bidder WHERE AuctionID=$id;");
        $statement->execute();

        return true;
    }

    public function getTaskName($name) {//gets the record with the imputed name with wilcards
        $statement = $this->_dbHandle->prepare("SELECT Auction.AuctionID, Users.Username, Item.ItemTitle, u2.Username as Bidder, HighestBid, StartDate, EndDate, Images.ImagePath1, Images.ImagePath2, Images.ImagePath3 FROM aee513.Auction INNER JOIN Users on Auction.SellerID=Users.UsersId INNER JOIN Item on Auction.ItemID=Item.ItemId INNER JOIN Images on Auction.ItemID=Images.ItemId INNER JOIN Users u2 on Auction.HighestBidder=u2.UsersId WHERE Item.ItemTitle LIKE ?;");

        $name='%'.$name.'%';
        $statement->bindParam(1, $name);
        $statement->execute();

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new AuctionData($row);
        }
        return $dataSet;

    }
}



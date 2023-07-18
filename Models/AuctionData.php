<?php

class AuctionData implements JsonSerializable {
    
    public $_id, $_item, $_seller, $_bidder, $_bid, $_start, $_end, $_image1, $_image2, $_image3;
    
    public function __construct($dbRow) {//deconstructs the array into fields
        $this->_id = $dbRow['AuctionID'];
        $this->_item = $dbRow['ItemTitle'];
        $this->_seller = $dbRow['Username'];
        $this->_bidder = $dbRow['Bidder'];
        $this->_bid = $dbRow['HighestBid'];
        $this->_start = $dbRow['StartDate'];
        $this->_end = $dbRow['EndDate'];
        $this->_image1 = $dbRow['ImagePath1'];
        $this->_image2 = $dbRow['ImagePath2'];
        $this->_image3 = $dbRow['ImagePath3'];
    }

    public function jsonSerialize(){//converts data into json arrays
        return[
            '_name'=> $this->_item,
            '_image'=> $this->_image1,
            '_bidder'=> $this->_bidder,
            '_bid'=> $this->_bid
        ];
    }

    //V Getters V
    public function getID() {
        return $this->_id;
    }
   
    public function getItem() {
       return $this->_item;
    }
    
    public function getSeller() {
       return $this->_seller;
    }

    public function getBidder() {
        return $this->_bidder;
    }

    public function getBid() {
        return $this->_bid;
    }

    public function getStart() {
        return $this->_start;
    }

    public function getEnd() {
        return $this->_end;
    }

    public function getImage1() {
        return $this->_image1;
    }

    public function getImage2() {
        return $this->_image2;
    }

    public function getImage3() {
        return $this->_image3;
    }
}



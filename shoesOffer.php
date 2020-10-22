<?php 
require_once 'offer.php';
class ShoesOffer extends Offer{
    private $discountRatio;
    public function __construct($ratio=0.1){
        parent::__construct();
        $this->discountRatio=$ratio;
        $this->offerName="10% off shoes: ";
    }
    public function calcDiscount($cart){
        if($this->status!="ACTIVE") return false; // the offer is not active right now;
        foreach($cart as $cartItem){
            if($cartItem=="Shoes"){
                $this->discountAmount+= ($this->itemsManager->getItemPrice($cartItem) *$this->discountRatio);
                $this->offerIsApplied=true;
            }
        }
        return $this->offerIsApplied;
    }
    
    
}
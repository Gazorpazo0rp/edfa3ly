<?php 
class TshirtJacketOffer extends offer{
    private $JacketDiscountRatio;
    public function __construct(){
        parent::__construct($ratio=0.5);
        $this->JacketDiscountRatio=$ratio;
        $this->offerName="50% off jacket: ";
    }
    public function calcDiscount($cart){
        // implement the virtual function -- The logic of the offer
        $numberOfTshirts=0;
        $numberOfJackets=0;
        foreach($cart as $cartItem){
            if($cartItem=="Jacket") $numberOfJackets+=1;
            if($cartItem=="T-shirt") $numberOfTshirts+=1;
        }
        $numberOfDiscounts=min(floor($numberOfTshirts/2),$numberOfJackets);
        $this->discountAmount= $numberOfDiscounts* $this->itemsManager->getItemPrice("Jacket")*$this->JacketDiscountRatio;
        return ($this->discountAmount>0) ? true : false;
    }
    
}
<?php 
require_once 'shoesOffer.php';
require_once 'tshirtJacketOffer.php';
class DiscountManager{
    private $offers;
    private $discountsDetails;
    private $currencyManager;
    private $currency;
    private $totalDiscount;
    public function __construct($currencyManager,$currency){
        $this->offers=[];
        $this->totalDiscount=0;
        $this->discountsDetails="";
        $this->currencyManager=$currencyManager;
        $this->currency=$currency;
        $shoesOffer=new ShoesOffer(0.1);
        array_push($this->offers,$shoesOffer);
        $tshirtJacketOffer= new TshirtJacketOffer();
        array_push($this->offers,$tshirtJacketOffer);
    }
    public function calcDiscounts($cart){
        
        foreach($this->offers as $offer){
            //check if this offer applies to the given cart
            // if it applies, convert it to suitable currency and append it to the discountsDetails
            if($offer->calcDiscount($cart)==true){
                $discountAmountWithCorrectCurrency=$this->currencyManager->convert($offer->getDiscountAmount(),$this->currency);
                $offer->setDiscountDetails($discountAmountWithCorrectCurrency);
                $this->totalDiscount+= $discountAmountWithCorrectCurrency;
                $this->discountsDetails .= $offer->getDiscountDetails();
            }
        }
    }
    public function getDiscountsDetails(){
        return $this->discountsDetails;
    }
    public function getTotalDiscount(){
        return $this->totalDiscount;
    }
}
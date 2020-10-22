<?php 
require_once 'itemsManager.php';
class Offer{
    protected $offerName;
    protected $status;
    protected $discountAmount;
    protected $discountDetails;
    protected $offerIsApplied;
    protected $itemsManager;
    public function __construct(){
        $this->status="ACTIVE";
        $this->discountAmount=0;
        $this->discountDetails="";
        $this->offerIsApplied=false;
        $this->itemsManager= new ItemsManager;
    }
    protected function getStatus(){
        return $this->status;
    }
    protected function setStatus($status){
        $this->status=$status;
    }
    public function getDiscountDetails(){
        return $this->discountDetails;
    }
    public function getDiscountAmount(){
        return $this->discountAmount;
    }
    public function checkIfOfferIsApplied(){
        return $this->offerIsApplied;
    }
    public function setDiscountDetails($discountAfterAdjustingCurrency){
        $this->discountDetails .= $this->offerName . $discountAfterAdjustingCurrency ."\n";
    }
}
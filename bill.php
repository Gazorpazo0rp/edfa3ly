<?php
require_once 'currencyManager.php';
require_once 'discountManager.php';
class Bill{
    private $subtotal;
    private $vat;
    private $total;
    private $billDetails;
    private $currency;
    private $currencyManager;
    private $discountManager;
    private $cartItems;
    private $itemsManager;
    public function __construct($cartItems,$currency,$itemsManager){
        $this->total=0;
        $this->total=0;
        $this->vat=0.14;
        $this->billDetails="";
        $this->currency=$currency;
        $this->cartItems=$cartItems;
        $this->itemsManager=$itemsManager;
        $this->currencyManager=new CurrencyManager();
    }
    private function calcSubtotal(){
        foreach($this->cartItems as $cartItem){
            $this->subtotal+=$this->itemsManager->getItemPrice($cartItem);
        }
        $this->subtotal = $this->currencyManager->convert($this->subtotal,$this->currency);
        $this->total=$this->subtotal;
        $this->billDetails .="Subtotal: ". $this->subtotal ." ". $this->currencyManager->getSymbol($this->currency)."\n";
    }
    private function getBillDetails(){
        return $this->billDetails;
    }
    private function appendToBillDetails($text){
        $this->billDetails .= $text;
    }
    private function updateTotal($updateAmount){
        $this->total += $updateAmount;
    }
    private function calcDiscount(){
        $discountManager=new DiscountManager($this->currencyManager,$this->currency);
        $discountManager->calcDiscounts($this->cartItems);
        $this->total -=$discountManager->getTotalDiscount();
        if($discountManager->getTotalDiscount()>0){
            // a discount actually was applied
            $this->billDetails .= "Discounts: " ."\n";
        }
        $this->appendToBillDetails($discountManager->getDiscountsDetails());
    }
    private function applyVat(){
        $vat =$this->vat * $this->total;
        $this->total+= $vat;
        $this->billDetails .= "Taxes: " . $vat .= "\n";
    }
    private function printTotal(){
        $this->billDetails .= "Total: " . $this->total .="\n";
    }
    public function issueBill(){
        $this->calcSubtotal();
        $this->applyVat();
        $this->calcDiscount();
        //Add vat
        $this->PrintTotal();
        return $this->billDetails;
    }
}
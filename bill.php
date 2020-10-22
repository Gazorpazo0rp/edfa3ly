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
        // loop through items, and calculate the subtotal in usd
        foreach($this->cartItems as $cartItem){
            $this->subtotal+=$this->itemsManager->getItemPrice($cartItem);
        }
        // convert to desired currency 
        $this->subtotal = $this->currencyManager->convert($this->subtotal,$this->currency);
        $this->total=$this->subtotal;
        // Append subtotal details to the bill
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
        // create a discount manager, Pass a currency manager because it'll need some conversion operations.
        $discountManager=new DiscountManager($this->currencyManager,$this->currency);
        // Execute the discounts 
        $discountManager->calcDiscounts($this->cartItems);
        // update the total
        $this->total -=$discountManager->getTotalDiscount();
        // If at least one discount happened, append the details to the bill
        if($discountManager->getTotalDiscount()>0){
            // a discount actually was applied
            $this->billDetails .= "Discounts: " ."\n";
            $this->appendToBillDetails($discountManager->getDiscountsDetails());
        }
    }
    private function applyVat(){
        // adds 14% to the total
        $vat =$this->vat * $this->total;
        $this->total+= $vat;
        $this->billDetails .= "Taxes: " . $vat .= "\n";
    }
    private function printTotal(){
        $this->billDetails .= "Total: " . $this->total .="\n";
    }
    public function issueBill(){
        // System core pipeline
        $this->calcSubtotal();
        $this->applyVat();
        $this->calcDiscount();
        $this->PrintTotal();
        return $this->billDetails;
    }
}
<?php
require 'itemsManager.php';
require_once 'currencyManager.php';
require 'bill.php';
require 'cartValidator.php';
require_once 'currencyValidator.php';
class BillingManager{
    private $itemsManager =null; 
    private $cartValidator=null;
    private $currencyValidator=null;
    private $currencyManager=null;
    public function __construct(){
        $this->itemsManager= new ItemsManager();
        $this->currencyManager=new CurrencyManager();
        $this->cartValidator=new CartValidator($this->itemsManager->getItemsNamesOnly());
        $this->currencyValidator=new CurrencyValidator($this->currencyManager->getCurrenciesNamesOnly());
    }
    public function getBill($cartItems,$currency){
        // first validate the cart
        $cartIsValid= $this->cartValidator->validate($cartItems);
        if(! $cartIsValid) {
            return "invalid cart";
        }
        $currencyIsValid=$this->currencyValidator->validate($currency);
        if(! $currencyIsValid){
            return "invalid currency";
        }
        // cart is valid
        // issue bill 
        $bill = new Bill($cartItems,$currency,$this->itemsManager);
        return $bill->issueBill();
    }
}
<?php
require_once 'currency.php';
class CurrencyManager{
    private $currencies;
    public function __construct(){
        // init available currencies
        $this->currencies=[];
        $usd=new Currency("USD","$",1);
        array_push($this->currencies,$usd);
        $egp= new Currency("EGP","e£",16);
        array_push($this->currencies,$egp);
        $euro= new Currency("EURO","€",1.1);
        array_push($this->currencies,$euro);
    }
    public function getCurrenciesNamesOnly(){
        // This method is needed to validate the currency submitted by the client.
        $names=[];
        foreach($this->currencies as $currency){
            array_push($names,$currency->getName());
        }
        return $names;
    }
    public function convert($amount,$currencyName){
        //this function converts from usd to any currency
        foreach($this->currencies as $currency){
            if($currency->getName()==$currencyName){
                return $amount*$currency->getConversionRate();
            }
        }
    }
    public function getSymbol($currencyName){
        // return a sybmol of a currency for printing purposes.
        foreach($this->currencies as $currency){
            if($currency->getName()==$currencyName){
                return $currency->getSymbol();
            }
        }
    }
}
<?php 
class currency{
    public $name;
    public $conversionRateToUSD;
    public $symbol;

    public function __construct($name,$symbol,$conversionRate){
        $this->name=$name;
        $this->symbol=$symbol;
        $this->conversionRateToUSD=$conversionRate;
    }
    public function getSymbol(){
        return $this->symbol;
    }
    public function getConversionRate(){
        return $this->conversionRateToUSD;
    }
    public function getName(){
        return $this->name;
    }
}
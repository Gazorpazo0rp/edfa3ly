<?php
require_once 'validator.php';
class CurrencyValidator extends Validator{
    public function validate($currency){
        return (in_array($currency,$this->validStrings)) ?true: false;
    }
}
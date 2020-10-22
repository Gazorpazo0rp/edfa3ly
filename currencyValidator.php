<?php
require_once 'validator.php';
class CurrencyValidator extends Validator{
    // Concrete class that extends Validator class.
    public function validate($currency){
        // Makes sure currency is supported
        return (in_array($currency,$this->validStrings)) ?true: false;
    }
}
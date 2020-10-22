<?php
require_once 'validator.php';
class CartValidator extends Validator{
    public function validate($cart){
        if(! is_array($cart)) return false;
        foreach($cart as $cartItem){
            if(!in_array($cartItem,$this->validStrings)) return false;
        }
        return true;
    }
}
<?php
require_once 'validator.php';
class CartValidator extends Validator{
    // concrete class that extends Validator
    public function validate($cart){
        // Make sure that EVERY item on the cart is valid
        // If at least one item is invalid the whole cart is invalid
        if(! is_array($cart)) return false;
        foreach($cart as $cartItem){
            if(!in_array($cartItem,$this->validStrings)) return false;
        }
        return true;
    }
}
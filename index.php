<?php
require 'billingManager.php';
if($_SERVER['REQUEST_METHOD']!='POST'){
    echo  "can't get this req";
}
else{
    if($_SERVER['REQUEST_URI']!="/edfa3ly/cart"){
        echo "couldn't find a proper handler for this request";
    }else{
        $cartItems=json_decode($_POST['cartItems']);
        if(isset($_POST['currency'])) $currency=json_decode($_POST['currency']);
        else {
            //default currency is USD
            $currency="USD";
        }
        $billingManager= new BillingManager();
        echo $billingManager->getBill($cartItems,$currency);
    }
}
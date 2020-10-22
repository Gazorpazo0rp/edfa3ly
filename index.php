<?php
require 'billingManager.php';
// Naive routing 
// It's naive on purpose -- The API has bascially one route only so It'll be overkill to implement an advanced router.
if($_SERVER['REQUEST_METHOD']!='POST'){
    echo  "can't get this req";
}
else{
    if($_SERVER['REQUEST_URI']!="/edfa3ly/cart"){
        // GET methods is not allowed
        echo "couldn't find a proper handler for this request";
    }else{
        $cartItems=json_decode($_POST['cartItems']);
        // Default currency is USD, it doesn;t have to be passed.
        if(isset($_POST['currency'])) $currency=json_decode($_POST['currency']);
        else {
            //default currency is USD
            $currency="USD";
        }
        // Create a Billing Manager 
        $billingManager= new BillingManager();
        // wait for a bill to be issued, or an error message and print it.
        echo $billingManager->getBill($cartItems,$currency);
    }
}
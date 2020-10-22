<?php 
class Subtotal{
    private $subtotal;
    public function __construct(){
        $this->subtotal=0;
    }
    public function getSubtotal($cart,$itemsManager){
        foreach($cart as $cartItem){
            $this->subtotal+=$itemsManager->getItemPrice($cartItem);
        }
        return $this->subtotal;
    }
}
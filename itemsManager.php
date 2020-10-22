<?php
require 'item.php';
class ItemsManager{
    private $items=[];
    public function __construct(){
        // this is where the available items are created
        $t_shirt=new item("T-shirt",10.99);
        array_push($this->items,$t_shirt);
        $pants=new item("Pants",14.99);
        array_push($this->items,$pants);
        $jacket=new item("Jacket",19.99);
        array_push($this->items,$jacket);
        $shoes=new item("Shoes",24.99);
        array_push($this->items,$shoes);
    }
    public function addItem($itemName, $itemPrice){
        $newItem=new item($itemName,$itemPrice);
        array_push($this->items,$newItem);
    }
    public function getItems(){
        return $this->items;
    }
    public function getItemsNamesOnly(){
        // needed for validating the cart
        $itemsNames=[];
        foreach($this->items as $item){
            array_push($itemsNames,$item->getName());
        }
        return $itemsNames;
    }
    public function getItemPrice($itemName){
        // get Item price by name
        foreach($this->items as $item){
            if($item->getName()== $itemName) return $item->getPrice();
        }
    }
}
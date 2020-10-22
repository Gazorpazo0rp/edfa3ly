<?php 
    class item{
        private $name;
        private $price;
        public function __construct($name,$price,$discount=0){
            $this->name=$name;
            $this->price=$price;
        }
        public function getName(){
            return $this->name;
        }
        public function getPrice(){
            return $this->price;
        }
        public function setPrice($price){
            $this->price=$price;
        }
    }
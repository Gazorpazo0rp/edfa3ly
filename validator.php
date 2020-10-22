<?php
class Validator{
    protected $validStrings;
    public function __construct($validStrings){
        $this->validStrings=$validStrings;
    }
}
<?php
class Validator{
    // A minimal class that all validators extend.
    protected $validStrings;
    public function __construct($validStrings){
        $this->validStrings=$validStrings;
    }
}
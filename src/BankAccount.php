<?php

class BankAccount{
    private $valute_type;
    private $value;

    public function __construct($valute){
        $this->valute_type = $valute;
    }

    public function get_valute(){
        return $this->valute_type;
    }
    public function get_value(){
        return $this->value;
    }
    public function set_value(float $new_value){
        $this->value = $new_value;
    }
}
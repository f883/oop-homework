<?php

require_once('BankAccount.php');

class Client{
    public $id;
    private $bank;
    public $accounts = [];

    public function __construct($id){
        $this->id = $id;
    }

    public function add_bank_account($valute){
        $account = new BankAccount($valute);
        $this->accounts[$valute] = $account;
    }

    public function get_bank(){
        return $this->bank;
    }
    public function set_bank($bank){
        $this->bank = $bank;
    }
}
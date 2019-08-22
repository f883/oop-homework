<?php

require_once('Client.php');

class Bank{
    private $clients = [];
    public $id;
    public $bank_to_bank_fee;
    private $center_bank;

    public function __construct($id, $bank_to_bank_fee = 0.05){
        $this->id = $id;
        $this->bank_to_bank_fee = $bank_to_bank_fee;
    }

    public function searchClient($id){
        if (!empty($this->clients[$id])){
            return $this->clients[$id];
        }
        else return null;
    }

    public function addClient(string $id){
        $id = $id;
        if (!empty($this->clients[$id])){
            throw new Exception("Client with id=[" . $id . "] already exists");
        }
        $client = new Client($id);
        $client->set_bank($this);
        $this->clients[$id] = $client;
        return $client;
    }

    public function get_center_bank(){
        return $this->center_bank;
    }    
    
    public function set_center_bank($center_bank){
        $this->center_bank = $center_bank;
    }
}
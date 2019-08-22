<?php

class BankTransfer{
    private $sender;
    private $receiver;
    private $valute;
    private $value;

    public function __construct(){
        
    }

    public function set_sender(Client $sender){
        $this->sender = $sender;
        return $this;
    }
    public function set_receiver(Client $receiver){
        $this->receiver = $receiver;
        return $this;
    }
    public function set_valute(string $valute){
        $this->valute = $valute;
        return $this;
    }
    public function set_value(float $value){
        $this->value = $value;
        return $this;
    }

    private function check_data(){
        if (empty($this->sender)){
            throw new Exception('Sender not set.');
        }
        if (empty($this->receiver)){
            throw new Exception('Reciever not set.');
        }
        if (empty($this->valute)){
            throw new Exception('Valute not set.');
        }
        if (empty($this->value)){
            throw new Exception('Value not set.');
        }
        else{
            if ($this->value <= 0){
                throw new Exception('Value less or equal zero.');
            }
        }
    }

    private function inner_transfer(){
        $this->check_data();

        $senders_account = $this->sender->accounts[$this->valute];
        $receivers_account = $this->receiver->accounts[$this->valute];

        if (empty($senders_account)){
            throw new Exception('Sender has no account with [' . $this->valute . '] valute.');
        }
        if (empty($receivers_account)){
            throw new Exception('Receiver has no account with [' . $this->valute . '] valute.');
        }

        if ($senders_account->get_value() < $receivers_account->get_value()){
            throw new Exception('Sender has not enough money.');
        }

        $senders_account->set_value($senders_account->get_value() - $this->value);
        $receivers_account->set_value($receivers_account->get_value() + $this->value);
        return true;
    }

    private function outer_transfer(){
        throw new Exception('Not implemented');        
    }

    public function execute(){
        $sender_bank = $this->sender->get_bank();
        $receiver_bank = $this->receiver->get_bank();

        if ($sender_bank === $receiver_bank){
            return $this->inner_transfer();
        }
        else{
            if ($sender_bank->get_center_bank() !== $receiver_bank->get_center_bank()){
                throw new Exception("Sender and receiver bank's should have one center bank.");
            }
            return $this->outer_transfer();
        }
    }
}
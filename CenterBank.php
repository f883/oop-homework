<?php

require_once('Bank.php');

class CenterBank{
    private $banks = [];

    public function registerBank($id, $bank_to_bank_fee = 0.05){
        $bank = new Bank($id, $bank_to_bank_fee);
        $this->banks[$id] = $bank;
        $bank->set_center_bank($this);
        return $bank;
    }

    public function unregisterBank($id){
        if (empty($this->banks[$id])){
            throw new Exception('Bank not found');
        }
        unset($this->banks[$id]);
        return true;
    }

    public function getBank($id){
        if (empty($this->banks[$id])){
            throw new Exception('Bank not found');
        }
        else{
            return $this->banks[$id];
        }
    }
    public function isCurrencyExists($id, $valute_type){
        if ($this->isBankExists($id)){
            if (empty($this->banks[$id][$valute_type])){
                return false;
            }
            else{
                return true;
            }
        }
        else{
            return false;
        }
    }

    public function isBankExists($id, $valute_type){
        if (empty($this->banks[$id])){
            return false;
        }
        else{
            return true;            
        }
    }
}
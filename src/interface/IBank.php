<?php

interface IBank{
    public function __construct($id, $bank_to_bank_fee = 0.05);
    // public function searchClient($id);
    public function addClient(string $id);
}
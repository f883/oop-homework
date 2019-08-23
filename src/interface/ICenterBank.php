<?php

interface ICenterBank{
    public function registerBank($id, $bank_to_bank_fee = 0.05);
    public function unregisterBank($id);
}
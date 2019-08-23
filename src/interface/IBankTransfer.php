<?php

interface IBankTransfer{
    public function execute();
    public function set_sender(Client $sender);
    public function set_receiver(Client $receiver);
    public function set_valute(string $valute);
    public function set_value($value);
}
<?php

// идентификатор клиента уникальный, другого такого же клиента не может быть

require_once('CenterBank.php');
require_once('BankTransfer.php');
require_once('Enums.php');

$centerBank = new CenterBank();
$pocket = $centerBank->registerBank('Pocket');
$tminkov = $centerBank->registerBank('Tminkov');

$c1 = $pocket->addClient('1');
$c2 = $pocket->addClient('2');

$c1->add_bank_account(VALUTE::$RUBLE);
$c2->add_bank_account(VALUTE::$RUBLE);

$c1->accounts[VALUTE::$RUBLE]->set_value(130.0);
$c2->accounts[VALUTE::$RUBLE]->set_value(100.0);

$transfer = new BankTransfer($centerBank);
$transfer->set_sender($c1)->set_receiver($c2)->set_valute(VALUTE::$RUBLE)->set_value(10.0);

try {
    $transfer->execute();
} catch (Exception $e) {
    echo 'Exception: ',  $e->getMessage(), "\n";
    return;
}

var_dump($c1);
var_dump($c2);
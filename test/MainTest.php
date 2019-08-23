<?php

require_once __DIR__ . '/../main.php';

use PHPUnit\Framework\TestCase;

final class MainTest extends TestCase
{
    public function testTest(): void
    {
        $centerBank = new CenterBank();

        $this->assertInstanceOf(
            CenterBank::class,
            $centerBank
        );
    }

    public function testMain(): void
    {
        $centerBank = new CenterBank();
        $pocket = $centerBank->registerBank('Pocket');
        $tminkov = $centerBank->registerBank('Tminkov');
        
        $c1 = $pocket->addClient('1');
        $c2 = $pocket->addClient('2');
        
        $c1->add_bank_account(VALUTE::$RUR);
        $c2->add_bank_account(VALUTE::$RUR);
        
        $c1->accounts[VALUTE::$RUR]->set_value(130);
        $c2->accounts[VALUTE::$RUR]->set_value(100);
        
        $transfer = new BankTransfer($centerBank);
        $transfer->set_sender($c1)->set_receiver($c2)->set_valute(VALUTE::$RUR)->set_value(10);
        
        $transfer->execute();
        $this->assertEquals($c1->accounts[VALUTE::$RUR]->get_value(), 120);
        $this->assertEquals($c2->accounts[VALUTE::$RUR]->get_value(), 110);
    }
}
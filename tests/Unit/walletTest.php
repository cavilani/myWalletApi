<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Wallet;


class walletTest extends TestCase
{    
    use DatabaseMigrations;


    protected function setUp()
    {
        parent::setUp();

        //Creating some mock objects to test
        $this->user = factory(User::class)->create(['email' => 'karolni90@gmail.com']);

        $this->wallet = factory(Wallet::class)
            ->create([
                'name' => 'My First Wallet',
                'currency' => 'GBP'
                ]);

        $this->transactionsArray =  [
                [
                    'walletId'      => $this->wallet->id,
                    'description'   => 'Fund transfer',
                    'amount'        => 30,
                    'date'          => '2018-03-06 11:15:00'
                ]

            ];

        foreach ($this->transactionsArray as $transaction) {
            
            $this->transactionsObjects[] = factory(Transaction::class)->create($transaction);
        }        

        
    }


    
    public function testGetTransactions()
    {   

        $wallet = new Wallet();
        $transactions = $wallet->getTransactions($this->wallet->id);

        $this->assertEquals($transactions[0],$this->$transactionsObjects[0]);

    }


}

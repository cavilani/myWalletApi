<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\User;


class walletTest extends TestCase
{    
    use DatabaseMigrations;


    protected function setUp() {

        parent::setUp();

        //Creating some mock objects to test
        $this->user = factory(User::class)->create(['email' => 'karolni90@gmail.com']);

        $this->wallet = factory(Wallet::class)
            ->create([
                'user_id' => $this->user->id,
                'name' => 'My First Wallet',
                'currency' => 'GBP'
                ]);

        $this->transactionsArray =  [
                [
                    'wallet_id'      => $this->wallet->id,
                    'description'   => 'Fund transfer',
                    'amount'        => 30,
                    'date'          => '2018-03-06 11:15:00'
                ]

            ];

        foreach ($this->transactionsArray as $transaction) {
            
            $this->transactionsObjects[] = factory(Transaction::class)->create($transaction);
        }       


    }


    
    public function testGetTransactions() {   

        $transactions = $this->wallet->getTransactions($this->wallet->id);

        $this->assertEquals(count($transactions),count($this->transactionsObjects));

        $this->assertEquals($transactions[0]->wallet_id,$this->transactionsObjects[0]->wallet_id);
        $this->assertEquals($transactions[0]->description,$this->transactionsObjects[0]->description);
        $this->assertEquals($transactions[0]->amount,$this->transactionsObjects[0]->amount);
        $this->assertEquals($transactions[0]->date,$this->transactionsObjects[0]->date);

    }


}

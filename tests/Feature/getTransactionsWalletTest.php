<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use App;

class getTransactionsWalletTest extends TestCase
{    
    use DatabaseMigrations;


    protected function setUp()
    {
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
                ],
                [
                    'wallet_id'      => $this->wallet->id,
                    'description'   => 'Top up',
                    'amount'        => 50,
                    'date'          => '2018-03-07 11:15:00'
                ]

            ];

        foreach ($this->transactionsArray as $transaction) {
            
            $this->transactionsObjects[] = factory(Transaction::class)->create($transaction);
        }        

        
    }


    
    public function testGetTransactionsWalletApi()
    {   

        //Method to test API endpoint without authentication
        Passport::actingAs($this->user,['getTransactionsWallet']);
 
        $response = $this->json('GET', '/api/getTransactionsWallet/'.$this->wallet->id);

        $expectedResponse = [
            'message'       => 'Success',
            'transactions'  => $this->transactionsArray
            ];

        $response
            ->assertStatus(200)
            ->assertJson($expectedResponse);

    }


}

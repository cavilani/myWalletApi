<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;

use App\Models\User;
use App;

class getTransactionsWalletTest extends TestCase
{
    
    public function testGetTransactionsWallet()
    {
        //Creating some mock objects to test
        $user = factory(User::class)->create(['email' => 'karolni90@gmail.com']);

        $wallet = factory(Wallet::class)
            ->create([
                'name' => 'My First Wallet',
                'currency' => 'GBP'
                ]);

        $transactionsTest =  [
                [
                'walletId'      => $wallet->id,
                'description'   => 'Fund transfer',
                'amount'        => 30,
                'date'          => '2018-03-06 11:15:00'
                ],
                [
                'walletId'      => $wallet->id,
                'description'   => 'Top up',
                'amount'        => 50,
                'date'          => '2018-03-07 11:15:00'
                ]

            ];

        foreach ($transactionsTest as $transaction) {
            
            factory(Transaction::class)->create($transaction);
        }        

        //Method to test API endpoint without authentication
        Passport::actingAs($user,['getTransactionsWallet']);
 
        $data = [        
            'walletId'         => $wallet->id,
            'numTransactions'  => '',
            'numPerPage'       => '',
            'pageNum'          => ''
          ];

        $response = $this->json('GET', '/api/getTransactionsWallet', $data);


        $expectedResponse = [
            'message'       => 'Success',
            'transactions'  => $transactionsTest
            ];

        $response
            ->assertStatus(200)
            ->assertJson($expectedResponse);

    }


}

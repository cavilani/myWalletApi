<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $userData = [
			        'name' 		=> 'Carolina',
			        'email' 	=> 'karolni90@gmail.com',
			        'password' 	=> '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
			        'remember_token' => str_random(10)
		    	];


        $user = \App\Models\User::create($userData);


        $walletData = [
                'user_id' 	=> $user->id,
                'name' 		=> 'My First Wallet',
                'currency' 	=> 'GBP',
                'balance'	=> 500
                ];

        $wallet = \App\Models\Wallet::create($walletData);
        

        $transactions =  [
                [
                    'wallet_id'      => $wallet->id,
                    'description'   => 'Fund transfer',
                    'amount'        => 30,
                    'date'          => '2018-03-06 11:15:00'
                ],
                [
                    'wallet_id'      => $wallet->id,
                    'description'   => 'Top up',
                    'amount'        => 50,
                    'date'          => '2018-03-07 11:15:00'
                ]

            ];

        foreach ($transactions as $transactionData) {
            
            \App\Models\Transaction::create($transactionData);
        } 

    }
}

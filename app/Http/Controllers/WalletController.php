<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends ApiController
{
    public function getTransactions($walletId) {

		if(!Wallet::checkIfExists($walletId)) {

	    	return SELF::errorResponse('invalid Wallet ID');            
	    }

	    $wallet = new Wallet();

	    $transactions = $wallet->getTransactions($walletId);

	    $response = self::getSuccessResponse();

	    $response['transactions'] = [];

	    foreach ($transactions as $transaction) {

	    	$response['transactions'][] = [

	    		'wallet_id' 	=> $transaction->wallet_id,
	    		'description' 	=> $transaction->description,
	    		'amount'		=> $transaction->amount,
	    		'date'			=> $transaction->date

	    		];
	    }


 		return response()->json($response);
 	}
    
}

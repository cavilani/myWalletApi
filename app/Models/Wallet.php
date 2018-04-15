<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Generic
{
    public function getTransactions($walletId) {

    	$wallet = Wallet::find($walletId);

    	if(!is_null($wallet)) {
    		return $wallet->transactions()->get();
    	}

    	return false;
    }

    public function transactions() {

        return $this->hasMany('App\Models\Transaction');
	}	
}

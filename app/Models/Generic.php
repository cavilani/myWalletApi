<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Generic extends Model
{
    public static function checkIfExists($id) {

    	return (!is_null(Self::find($id)));
    }
}

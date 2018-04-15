<?php

use Faker\Generator as Faker;
use App\Models\Wallet;

$factory->define(Wallet::class, function (Faker $faker) {
    return [
        'name' 	   => $faker->name,
        'currency' => 'GBP',
        'balance'  => $faker->randomFloat
    ];
});

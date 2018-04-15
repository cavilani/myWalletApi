<?php

use Faker\Generator as Faker;
use App\Models\Transaction;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'description' 	=> $faker->title,
        'amount' 		=> $faker->randomFloat,
        'date'  		=> $faker->dateTime
    ];
});

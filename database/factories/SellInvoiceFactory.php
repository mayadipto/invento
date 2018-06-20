<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SellInvoice::class, function (Faker $faker) {
    return [
        'code'=> 'sell-'.$faker->unique()->numberBetween(1000000,9999999),
        'sell_by'=> function(){
            return \App\User::all()->random();
        },
        'customer_id'=> function(){
            return \App\Models\Customer::all()->random();
        },
        'total_purchase_price'=> $faker->randomElement([1000,1500,1400,1800,1600,1300,2000]),
        'total_sell_price'=> $faker->randomElement([1800,1900,2000,2200,2100,2500,2600])
    ];
});

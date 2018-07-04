<?php

use Faker\Generator as Faker;

$factory->define(App\Models\SellInvoice::class, function (Faker $faker) {
    $purchase_amount = $faker->randomElement([1000,1500,1400,1800,1600,1300,2000]);
    $sell_amount = (($purchase_amount*$faker->numberBetween(10,20))/100) + $purchase_amount;
    $vat = 15;
    return [
        'code'=> 'sell-'.$faker->unique()->numberBetween(1000000,9999999),
        'sell_by'=> function(){
            return \App\User::all()->random();
        },
        'customer_id'=> function(){
            return \App\Models\Customer::all()->random();
        },
        'total_purchase_price'=> $purchase_amount,
        'total_sell_price'=> $sell_amount,
        'vat'=> $vat,
        'vat_amount'=> (($sell_amount*$vat)/100)
    ];
});

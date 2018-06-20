<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PurchaseInvoice::class, function (Faker $faker) {
    return [
        'code'=> 'pur-'.$faker->unique()->numberBetween(1000000,9999999),
        'purchased_by'=> function(){
            return \App\User::all()->random();
        },
        'supplier_id'=> function(){
            return \App\Models\Supplier::all()->random();
        },
        'total_purchase_price'=> $faker->randomElement([1000,1200,800,2000,3000,2500, 2200])
    ];
});

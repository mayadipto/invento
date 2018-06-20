<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Purchase::class, function (Faker $faker) {
    $item = \App\Models\Item::all()->random();
    return [
        'purchase_invoice_id'=> function(){
            return \App\Models\PurchaseInvoice::all()->random();
        },
        'item_id'=> $item->id,
        'quantity'=> $faker->randomElement([50,60,40,30,20,25,35]),
        'purchase_price'=> $item->purchase_price,
        'sell_price' => $item->sell_price,
        'details' => $faker->text(150)
    ];
});

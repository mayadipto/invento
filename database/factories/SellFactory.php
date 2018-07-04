<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Sell::class, function (Faker $faker) {
    $item = \App\Models\Item::all()->random();
    $quantity = $faker->randomElement([5,10,15,20,25]);
    return [
        'sell_invoice_id'=> function(){
            return \App\Models\SellInvoice::all()->random();
        },
        'item_id'=> $item->id,
        'quantity'=> $quantity,
        'purchase_price'=> $item->purchase_price,
        'sell_price'=> $item->sell_price,
        'details'=> $faker->text(80),
        'discount'=> $item->discount
    ];
});

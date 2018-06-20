<?php

use Faker\Generator as Faker;

$factory->define(App\Models\UsedItem::class, function (Faker $faker) {
    $item = \App\Models\Item::all()->random();
    $quantity = $faker->randomElement([5,6,10,12,15,20,18,25]);
    return [
        'item_id'=> $item->id,
        'quantity'=> $quantity,
        'used_item_invoice_id'=> function(){
            return \App\Models\UsedItemInvoice::all()->random();
        },
        'purchase_price' => $item->purchase_price,
        'total'=> $item->purchase_price * $quantity
    ];
});

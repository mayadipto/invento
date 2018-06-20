<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Item::class, function (Faker $faker) {
    $purchase_price = $faker->randomElement([10,20,30,25,35,40,50,15]);
    return [
        'name' => $faker->word,
        'brand_id' => function(){
            return \App\Models\Brand::all()->random();
        },
        'item_category_id' => function(){
            return \App\Models\ItemCategory::all()->random();
        },
        'code' => $faker->unique()->text(10),
        'quantity'=> rand(100,200),
        'purchase_price'=> $purchase_price,
        'sell_price'=> $purchase_price+rand(5,10),
        'details' => $faker->paragraph,
        'unit' => function(){
            $unit = array('kg','meter','litter','gram','pcs');
            return $unit[array_rand($unit)];
        }
    ];
});

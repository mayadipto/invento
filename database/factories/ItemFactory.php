<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Item::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'brand_id' => function(){
            return \App\Models\Brand::all()->random();
        },
        'item_category_id' => function(){
            return \App\Models\ItemCategory::all()->random();
        },
        'code' => $faker->unique()->text(10),
        'details' => $faker->paragraph,
        'unit' => function(){
            $unit = array('kg','meter','litter','gram','pcs');
            return $unit[array_rand($unit)];
        }
    ];
});

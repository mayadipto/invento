<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ExpenseItem::class, function (Faker $faker) {
    $price = 0;
    return [
        'name'=> $faker->unique()->word,
        'brand_id'=> function(){
            return App\Models\Brand::all()->random();
        },
        'expense_category_id'=> function(){
            return App\Models\ExpenseCategory::all()->random();
        },
        'code'=> $faker->unique()->text(10),
        'details'=> $faker->paragraph,
        'unit'=> function(){
            $unit = array('kg','meter','litter','gram','pcs');
            return $unit[array_rand($unit)];
        }
    ];
});

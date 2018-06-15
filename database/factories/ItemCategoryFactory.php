<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ItemCategory::class, function (Faker $faker) {
    return [
        'name'=> $faker->unique()->word,
        'code'=> $faker->unique()->text(10),
        'raw_material'=> function(){
            if(rand(1,20)>10){
                return true;
            }else{
                return false;
            }
        },
        'details'=> $faker->paragraph,
        'parent_id'=>function(){
            if(rand(1,10)>=10){
                return null;
            }else{
                $categories = \App\Models\ItemCategory::all();
                if(count($categories)>0){
                    return $categories->random();
                }
                return null;
            }
        }
    ];
});

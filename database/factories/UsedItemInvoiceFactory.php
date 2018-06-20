<?php

use Faker\Generator as Faker;

$factory->define(App\Models\UsedItemInvoice::class, function (Faker $faker) {
    return [
        'code'=> 'used-'.$faker->numberBetween(1000000, 9999999),
        'used_by' => function(){
            return \App\Models\Employee::all()->random();
        },
        'total_used_amount'=> $faker->randomElement([400,500,600,700,800,300])
    ];
});

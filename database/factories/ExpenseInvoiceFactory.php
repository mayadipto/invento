<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ExpenseInvoice::class, function (Faker $faker) {
    return [
        'code' => 'expense-'.$faker->numberBetween(1000000, 9999999),
        'expense_by'=> function(){
            return \App\Models\Employee::all()->random();
        },
        'total_amount'=> $faker->randomElement([3000, 5000, 4000, 6000, 2000]),
    ];
});

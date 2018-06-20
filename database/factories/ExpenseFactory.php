<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Expense::class, function (Faker $faker) {
    return [
        'expense_invoice_id' => function(){
            return \App\Models\ExpenseInvoice::all()->random();
        },
        'amount' => $faker->randomElement([1000,500,600,200,1500,800]),
        'details' => $faker->text(150)
    ];
});

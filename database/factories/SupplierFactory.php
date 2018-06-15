<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Supplier::class, function (Faker $faker) {
    return [
        'name'=> $faker->name,
        'code'=> $faker->bankAccountNumber,
        'address'=> $faker->address,
        'contact_no'=> $faker->phoneNumber,
        'email'=> $faker->email
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Customer::class, function (Faker $faker) {
    return [
        'code' => 'customer'.$faker->unique()->numberBetween(10000,99999),
        'name'=> $faker->name,
        'address'=> $faker->address,
        'contact_no'=> $faker->phoneNumber,
        'email'=> $faker->unique()->email
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Employee::class, function (Faker $faker) {
    return [
        'code'=>'emp-'.$faker->unique()->numberBetween(100000, 999999),
        'name'=> $faker->name,
        'designation'=> $faker->randomElement(['Sales man', 'Security Guard', 'Manager', 'Operator', 'Supervisor', 'Director']),
        'permanent_address'=> $faker->address,
        'present_address' => $faker->address,
        'contact_no'=> $faker->unique()->phoneNumber,
        'nid'=> $faker->unique()->bankAccountNumber,
        'religion'=>$faker->randomElement(['Islam', 'Hindu', 'Buddha', 'Kristian', 'Other']),
        'status'=> $faker->numberBetween(0, 5)

    ];
});

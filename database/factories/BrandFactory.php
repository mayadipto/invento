<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Brand::class, function (Faker $faker) {
    return [
        'name'=> $faker->company,
        'details'=> $faker->paragraph,
        'image'=> 'https://firebasestorage.googleapis.com/v0/b/professional-d6f48.appspot.com/o/advertisements%2F32585755_189069725067015_9016162099868467200_n.jpg?alt=media&token=b0316f27-2019-42fe-99a5-01fa646a187c'
    ];
});

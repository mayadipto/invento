<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ExpenseCategory::class, function (Faker $faker) {
    return [
//        $table->engine = 'InnoDB';
//        $table->increments('id');
//        $table->string('name', 50)->unique();
//        $table->string('code', 20)->unique();
//        $table->text('details')->nullable();
//
//        $table->unsignedInteger('parent_id')->nullable()->index();
//        $table->foreign('parent_id')->references('id')->on('expense_categories')->onDelete('cascade');
//
//        $table->timestamps();
        'name'=> $faker->unique()->name,
        'code'=> $faker->unique()->text(10),
        'details'=> $faker->paragraph,
        'parent_id'=> function(){
            if(rand(1,10)>=10){
                return null;
            }else{
                $categories = \App\Models\ExpenseCategory::all();
                if(count($categories)>0){
                    return $categories->random();
                }
                return null;
            }
        }

    ];
});

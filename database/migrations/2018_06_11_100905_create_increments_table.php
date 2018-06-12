<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncrementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('increments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->unsignedInteger('salary_id')->index();
            $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('cascade');

            $table->unsignedInteger('employee_id')->index();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');



            $table->unsignedDecimal('basic');
            $table->unsignedDecimal('house_rent');
            $table->unsignedDecimal('others');

            $table->unsignedDecimal('previous_basic');
            $table->unsignedDecimal('previous_house_rent');
            $table->unsignedDecimal('previous_others');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('increments');
    }
}

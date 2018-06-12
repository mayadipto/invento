<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code', 20)->unique();

            $table->unsignedInteger('user_id')->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('name',80);
            $table->string('father', 80)->nullable();
            $table->string('mother', 80)->nullable();

            $table->string('designation', 30);

            $table->text('permanent_address');
            $table->text('present_address');
            $table->string('contact_no');
            $table->string('email',50)->nullable();
            $table->string('district', 20)->nullable();

            $table->string('nid',30);
            $table->string('religion',20);
            $table->date('dob')->nullable();

            $table->longText('other_details')->nullable();
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
        Schema::dropIfExists('employees');
    }
}

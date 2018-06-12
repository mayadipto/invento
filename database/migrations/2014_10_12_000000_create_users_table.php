<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            /**
             * ROLES
             * customer = 1
             * employee = 2
             * supplier = 3
             * moderator = 4
             * admin = 5
             * super = 6
             *
             */
            $table->unsignedTinyInteger('role')->default(1);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            /**
             * STATUS
             * disabled = 0
             * active = 1
             * suspended = 2
             */
            $table->unsignedTinyInteger('status')->default(0);
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
        Schema::dropIfExists('users');
    }
}

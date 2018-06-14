<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->unsignedInteger('expense_item_id')->index();
            $table->foreign('expense_item_id')->references('id')->on('expense_items')->onDelete('cascade');

            $table->unsignedInteger('expense_by')->index();
            $table->foreign('expense_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('quantity');
            $table->decimal('price',8,2);
            $table->longText('details')->nullable();

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
        Schema::dropIfExists('expenses');
    }
}

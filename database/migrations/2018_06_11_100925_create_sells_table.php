<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->unsignedInteger('sell_invoice_id')->index();
            $table->foreign('sell_invoice_id')->references('id')->on('sell_invoices')->onDelete('cascade');

            $table->unsignedInteger('item_id')->index();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

            $table->unsignedInteger('quantity');
            $table->decimal('purchase_price');
            $table->decimal('sell_price');
            $table->decimal('discount')->default(0);
            $table->decimal('total');
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
        Schema::dropIfExists('sells');
    }
}

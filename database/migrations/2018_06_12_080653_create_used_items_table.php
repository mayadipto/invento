<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('used_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->unsignedInteger('used_item_invoice_id')->index();
            $table->foreign('used_item_invoice_id')->references('id')->on('used_item_invoices')->onDelete('cascade');

            $table->unsignedInteger('item_id')->index();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');


            $table->unsignedInteger('quantity');
            $table->decimal('purchase_price');
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
        Schema::dropIfExists('used_items');
    }
}

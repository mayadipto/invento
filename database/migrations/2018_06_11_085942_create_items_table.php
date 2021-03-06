<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);

            $table->unsignedInteger('brand_id')->index();
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->unsignedInteger('item_category_id')->index();
            $table->foreign('item_category_id')->references('id')->on('item_categories')->onDelete('cascade');

            $table->string('code', 50)->unique();
            $table->text('details')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->string('unit', 20);
            $table->decimal('purchase_price')->nullable();
            $table->decimal('sell_price')->nullable();
            $table->decimal('discount')->default(0);
            $table->boolean('deleted')->default(false);

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
        Schema::dropIfExists('items');
    }
}

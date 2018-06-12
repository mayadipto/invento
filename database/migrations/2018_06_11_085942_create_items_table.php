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
            $table->string('name', 100)->unique();

            $table->unsignedInteger('brand_id')->index();
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->unsignedInteger('item_category_id')->index();
            $table->foreign('item_category_id')->references('id')->on('item_categories')->onDelete('cascade');

            $table->string('code', 20)->unique();
            $table->text('details')->nullable();
            $table->string('unit', 20);
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

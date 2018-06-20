<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sell_invoices', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('code', 50)->unique();

            $table->unsignedInteger('sell_by')->index();
            $table->foreign('sell_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('customer_id')->nullable()->index();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->decimal('total_purchase_price');
            $table->decimal('total_sell_price');
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
        Schema::dropIfExists('sell_invoices');
    }
}

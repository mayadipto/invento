<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('code')->unique();

            $table->unsignedInteger('purchased_by')->index();
            $table->foreign('purchased_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('supplier_id')->index();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->decimal('total_purchase_price');

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
        Schema::dropIfExists('purchase_invoices');
    }
}

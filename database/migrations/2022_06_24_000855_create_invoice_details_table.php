<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_invoices')->nullable();
            $table->foreign('id_invoices')->references('id')->on('invoices');
            $table->unsignedBigInteger('id_products')->nullable();
            $table->foreign('id_products')->references('id')->on('products');
            $table->unsignedBigInteger('id_seller')->nullable();
            $table->foreign('id_seller')->references('id')->on('users');
            $table->unsignedBigInteger('quantity')->nullable();
            $table->decimal('price', 12 , 2)->nullable();
            $table->decimal('total', 12 , 2)->nullable();
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
        Schema::dropIfExists('invoice_details');
    }
};

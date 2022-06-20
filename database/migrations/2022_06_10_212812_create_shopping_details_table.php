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
        Schema::create('shopping_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_shoppings')->nullable();
            $table->foreign('id_shoppings')->references('id')->on('shoppings');
            $table->unsignedBigInteger('id_products')->nullable();
            $table->foreign('id_products')->references('id')->on('products');
            $table->unsignedBigInteger('quantity')->nullable();
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
        Schema::dropIfExists('shopping_details');
    }
};

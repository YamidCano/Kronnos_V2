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
        Schema::create('payment_outs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_provider')->nullable();
            $table->foreign('id_provider')->references('id')->on('providers');
            $table->unsignedBigInteger('id_shoppings')->nullable();
            $table->foreign('id_shoppings')->references('id')->on('shoppings');
            $table->decimal('amount', 12 , 2)->nullable();
            $table->date('date')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('id_payment_modes')->nullable();
            $table->foreign('id_payment_modes')->references('id')->on('payment_modes');
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
        Schema::dropIfExists('payment_outs');
    }
};

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
        Schema::create('payment_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger('id_client')->nullable();
            $table->foreign('id_client')->references('id')->on('users');
            $table->unsignedBigInteger('id_invoice')->nullable();
            $table->foreign('id_invoice')->references('id')->on('invoices');
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
        Schema::dropIfExists('payment_entries');
    }
};

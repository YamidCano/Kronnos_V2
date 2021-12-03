<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_bill_details')->nullable();
            $table->foreign('id_bill_details')->references('id')->on('bill_details');

            $table->unsignedBigInteger('id_seller')->nullable();
            $table->foreign('id_seller')->references('id')->on('users');

            $table->unsignedBigInteger('id_client')->nullable();
            $table->foreign('id_client')->references('id')->on('users');

            $table->unsignedBigInteger('id_payment_type')->nullable();
            $table->foreign('id_payment_type')->references('id')->on('payment_types');

            $table->unsignedBigInteger('id_credit_history')->nullable();
            $table->foreign('id_credit_history')->references('id')->on('credit_histories');

            $table->integer('price')->nullable();
            $table->integer('IVA')->nullable();
            $table->integer('total_price')->nullable();

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
        Schema::dropIfExists('bills');
    }
}

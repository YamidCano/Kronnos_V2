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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique()->nullable();
            $table->string('slug')->unique()->nullable();
            $table->unsignedBigInteger('id_seller')->nullable();
            $table->foreign('id_seller')->references('id')->on('users');
            $table->unsignedBigInteger('id_provider')->nullable();
            $table->foreign('id_provider')->references('id')->on('providers');
            $table->date('date')->nullable();
            $table->bigInteger('order_status')->nullable();
            $table->unsignedBigInteger('id_taxe')->nullable();
            $table->foreign('id_taxe')->references('id')->on('taxes');
            $table->text('note')->nullable();
            $table->decimal('Subtotal', 12 , 2)->nullable();
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
        Schema::dropIfExists('invoices');
    }
};

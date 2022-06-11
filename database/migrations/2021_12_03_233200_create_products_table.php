<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();

            $table->bigInteger('code')->unique()->nullable();
            $table->decimal('price', 12 , 2)->unique()->nullable();
            $table->decimal('price_sale', 12 , 2)->unique()->nullable();
            $table->string('slug')->unique()->nullable();

            $table->unsignedBigInteger('id_product_categories')->nullable();
            $table->foreign('id_product_categories')->references('id')->on('product_categories');

            $table->unsignedBigInteger('id_brands')->nullable();
            $table->foreign('id_brands')->references('id')->on('brands');

            $table->string('photo')->nullable();
            // $table->string('sliderphoto')->nullable();
            // $table->string('new')->nullable();
            $table->text('description')->nullable();
            // $table->text('descriptionLong')->nullable();
            // $table->text('Specifications')->nullable();
            // $table->bigInteger('visits')->nullable();
            // $table->bigInteger('sales')->nullable();
            $table->char('status')->nullable();
            // $table->char('slider')->nullable();

            $table->integer('stock')->nullable()->default(0);
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
        Schema::dropIfExists('products');
    }
}

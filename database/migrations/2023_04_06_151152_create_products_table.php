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
            $table->string('product_code',10);
            $table->integer('category_id')->unsigned();
            $table->string('name',50);
            $table->string('dimensions');
            $table->string('materials');
            $table->string('color');
            $table->string('price');
            $table->text('description')->nullable();
            $table->string('link_shopee')->nullable();
            $table->timestamps();
            $table->primary('product_code');
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
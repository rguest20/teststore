<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->string('product_name');
            $table->string('product_description')->nullable();
            $table->decimal('price');
            $table->string('image')->nullable();
            $table->integer('units')->nullable();
            $table->boolean('flash_sale')->nullable();
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

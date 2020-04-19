<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('primary_category_id')->unsigned();
            $table->integer('secondary_category_id')->unsigned();
            $table->string('title');
            $table->string('featured_image')->nullable();
            $table->text('features');
            $table->tinyInteger('is_featured')->default(0)->nullable();
            $table->longText('description');
            $table->double('price');
            $table->integer('stock')->comment('0 => Out of Stock, 1 => In Stock');
            $table->integer('status');
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

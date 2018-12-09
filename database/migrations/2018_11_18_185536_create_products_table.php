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
            $table->integer('farmer_id');
            $table->string('name');
            $table->string('slug');
            $table->integer('category_id');
            $table->string('thumbnail');
            $table->double('price', 20, 2);
            $table->string('unit', 50)->default('kg');
            $table->integer('quantity');
            $table->float('discount', 6,2);
            $table->text('description');
            $table->text('content')->nullable();
            $table->integer('delete');
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

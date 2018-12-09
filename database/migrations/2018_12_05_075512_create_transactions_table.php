<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('farmer_id');
            $table->unsignedInteger('trader_id');
            $table->unsignedInteger('trader_contact_id');
            $table->unsignedInteger('transaction_detail_id');
            $table->integer('status')->default(0);
            $table->integer('payment')->default(0);
            $table->integer('typeTran')->default(0);
            $table->double('total', 20,2);
            $table->unsignedInteger('farmer_delete')->default(0);
            $table->unsignedInteger('trader_delete')->default(0);
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
        Schema::dropIfExists('transactions');
    }
}

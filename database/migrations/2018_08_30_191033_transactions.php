<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function(Blueprint $table){
           $table->increments('id')->unsigned();
           $table->bigInteger('shopify_transaction_id')->unsigned();
           $table->json('shopify_transaction');
           $table->bigInteger('gift_card_id')->nullabled()->default(0);
           $table->integer('amount')->unsigned()->default(0);

           $table->integer('order_id')->unsigned();
           $table->foreign('order_id')->references('id')->on('orders')->onDelete('CASCADE');

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

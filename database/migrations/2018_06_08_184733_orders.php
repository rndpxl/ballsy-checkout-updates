<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         *
         * Orders:
         *   id, shopify_order_id, customer_email, gift_card_code, shopify_storefront_id
         *
         *   Storefronts:
         *   id, shop_domain, api_key, api_secret, access_token
         */


        Schema::create('storefronts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shop_domain');
            $table->string('access_token');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('shopify_order_id')->unsigned();
            $table->json('shopify_order');
            $table->string('customer_email');

            $table->integer('storefront_id')->unsigned();
            $table->foreign('storefront_id')->references('id')->on('storefronts');


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
        Schema::dropIfExists('orders');
        Schema::dropIfExists('storefronts');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned()->nullable();
            $table->unique(array('event_id', 'product_id'), 'event_product_unique');
            $table->timestamps();
        });
        Schema::table('event_product', function (Blueprint $table) {
            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropUnique('event_product_unique');
        Schema::dropForeign('event_product_event_id_foreign');
        Schema::dropForeign('event_product_product_id_foreign');
        Schema::drop('event_product');
    }
}

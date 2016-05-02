<?php

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
            $table->string('title', 255);
            $table->string('video_link', 255);
            $table->string('product_link', 255);
            $table->string('image_link', 255);
            $table->integer('channel_id')->unsigned()->nullable();
            $table->integer('old_price');
            $table->integer('new_price');
            $table->text('description');
            $table->integer('start_time');
            $table->integer('end_time');
            $table->integer('available_time');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('products', function(Blueprint $table){
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function(Blueprint $table){
            $table->dropForeign('products_channel_id_foreign');
        });
        Schema::drop('products');
    }
}

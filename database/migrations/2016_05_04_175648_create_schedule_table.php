<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('start_time');
            $table->integer('end_time');
            $table->string('start_date', 12);
            $table->timestamps();
        });
        Schema::table('schedule', function (Blueprint $table){
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
        Schema::table('schedule', function($table){
            $table->dropForeign('schedule_product_id_foreign');
        });
        Schema::drop('schedule');
    }
}

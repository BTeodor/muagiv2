<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueToWatchRecentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('watch_recent', function (Blueprint $table) {
            //
            $table->unique(array('user_id', 'product_id'), 'watch_recent_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('watch_recent', function (Blueprint $table) {
            //
            $table->dropUnique('watch_recent_unique');
        });
    }
}

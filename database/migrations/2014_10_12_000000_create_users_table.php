<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('email', 80)->unique();
			$table->string('username')->nullable()->unique();
			$table->string('password');
			$table->string('name', 80);
			$table->integer('gender');
			$table->integer('occupation');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('phone')->nullable();
			$table->string('avatar')->nullable();
			$table->string('address')->default('');
			$table->unsignedInteger('country_id')->nullable();
			$table->date('birthday')->nullable();
			$table->timestamp('last_login')->nullable();
			$table->string('confirmation_token', 60)->nullable();
			$table->string('status', 20);
			$table->integer('two_factor_country_code')->nullable();
			$table->integer('two_factor_phone')->nullable();
			$table->text('two_factor_options')->nullable();
			$table->softDeletes();
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('users');
	}
}

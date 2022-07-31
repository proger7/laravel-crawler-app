<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->boolean('is_admin')->default(0);
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->string('provider')->nullable();
			$table->string('provider_id')->nullable();
			$table->text('avatar')->nullable();
			$table->timestamps();
			// $table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}

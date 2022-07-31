<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigurationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('configurations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->nullable();
			$table->string('v_url', 191)->nullable();
			$table->string('v_site_url', 191)->nullable();
			$table->string('v_content_type', 191)->nullable();
			$table->string('v_filter_type', 191)->nullable();
			$table->string('v_function', 191)->nullable();
			$table->index(['v_site_url', 'v_content_type', 'v_function']);
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
		Schema::drop('configurations');
	}

}

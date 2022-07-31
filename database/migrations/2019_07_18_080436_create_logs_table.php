<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('v_status', 191)->nullable();
			$table->integer('n_parsed_qua')->nullable()->default(0);
			$table->string('v_url', 191)->nullable();
			$table->string('v_site_url', 191)->nullable();
			$table->string('v_content_type', 191)->nullable();
			$table->string('v_comment', 191)->nullable();
			$table->string('v_command', 191)->nullable();
			$table->index(['v_status', 'n_parsed_qua', 'v_url', 'v_command']);
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
		Schema::drop('logs');
	}

}

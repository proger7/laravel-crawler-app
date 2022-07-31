<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageNodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image_nodes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('n_product_id')->nullable()->default(0);
			$table->string('v_product_url', 191)->nullable();
			$table->text('v_gallery_item')->nullable();
			$table->string('v_parsing_type', 191)->nullable();
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
		Schema::drop('image_nodes');
	}

}

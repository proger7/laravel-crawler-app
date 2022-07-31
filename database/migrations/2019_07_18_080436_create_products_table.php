<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id')->unsigned()->nullable()->index();
			$table->string('site_url', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->string('category_alias', 191)->nullable();
			$table->string('category_url', 191)->nullable();
			$table->string('category_name', 191)->nullable();
			$table->string('category_type', 191)->nullable();
			$table->string('price', 191)->nullable();
			$table->text('v_image_name_local')->nullable();
			$table->text('v_image_path_local')->nullable();
			$table->text('main_image_url')->nullable();
			$table->string('image_size', 191)->nullable();
			$table->string('images_urls', 191)->nullable();
			$table->text('text_description')->nullable();
			$table->integer('is_promotional')->nullable()->default(0);
			$table->integer('is_new')->nullable()->default(0);
			$table->string('old_price', 191)->nullable();
			$table->string('new_price', 191)->nullable();
			$table->text('product_configure')->nullable();
			$table->text('product_content')->nullable();
			$table->string('url', 191)->nullable();
			$table->string('v_command', 191)->nullable();
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
		Schema::drop('products');
	}

}

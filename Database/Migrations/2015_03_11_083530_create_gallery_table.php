<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if ( ! Schema::hasTable('gallery'))
		{
			Schema::create('gallery', function(Blueprint $table) {
				$table->increments('id');
				$table->string('file_name', 150);
				$table->string('path', 150);
				$table->string('caption', 150);
				$table->bigInteger('user_id');
				$table->enum('type', ['photo', 'video']);
				$table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migration.
	 *
	 * @return void
	 */
	public function down()
	{
		if (Schema::hasTable('gallery'))
		{
			Schema::drop('gallery');
		}
	}
}
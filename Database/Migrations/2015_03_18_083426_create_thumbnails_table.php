<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThumbnailsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if ( ! Schema::hasTable('thumbnails'))
		{
			Schema::create('thumbnails', function(Blueprint $table) {
				$table->increments('id');
				$table->bigInteger('photo_id');
				$table->string('thumb_name', 150)->unique();
				$table->string('path', 150);
				$table->integer('width');
				$table->integer('height');
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
		if (Schema::hasTable('thumbnails'))
		{
			Schema::drop('thumbnails');
		}
	}
}
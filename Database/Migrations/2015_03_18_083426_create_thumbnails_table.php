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
				$table->bigIncrements('id');

				$table->bigInteger('photo_id')->unsigned();
				$table->foreign('photo_id')->references('id')->on('gallery');

				$table->string('thumb_name', 150)->unique()->index();
				$table->string('path', 150);
				$table->integer('width')->unsigned()->index();
				$table->integer('height')->unsigned()->index();
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
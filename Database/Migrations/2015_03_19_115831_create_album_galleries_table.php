<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumGalleriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if ( ! Schema::hasTable('album_galleries'))
		{
			Schema::create('album_galleries', function(Blueprint $table) {
				$table->bigIncrements('id');
				$table->bigInteger('gallery_id')->unsigned();
				$table->foreign('gallery_id')->references('id')->on('gallery');
				$table->bigInteger('album_id')->unsigned();
				$table->foreign('album_id')->references('id')->on('albums');
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
		if (Schema::hasTable('album_galleries'))
		{
			Schema::drop('album_galleries');
		}
	}
}
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
				$table->bigIncrements('id');
				$table->string('file_name', 150)->index();
				$table->string('path', 150);
				$table->string('caption', 150)->index();
				$table->bigInteger('user_id')->unsigned();
				$table->foreign('user_id')->references('id')->on('users');
				$table->enum('type', ['photo', 'video'])->index();
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
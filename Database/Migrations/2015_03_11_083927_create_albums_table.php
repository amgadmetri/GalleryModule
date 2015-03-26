<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if ( ! Schema::hasTable('albums'))
		{
			Schema::create('albums', function(Blueprint $table) {
				$table->increments('id');
				$table->string('album_name', 150);
				$table->bigInteger('user_id');
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
		if (Schema::hasTable('albums'))
		{
			Schema::drop('albums');
		}
	}
}
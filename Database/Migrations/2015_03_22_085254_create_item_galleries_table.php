<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemGalleriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if ( ! Schema::hasTable('item_galleries'))
		{
			Schema::create('item_galleries', function(Blueprint $table) {
				$table->increments('id');
				$table->bigInteger('gallery_id');
				$table->string('gallery_type');
				$table->bigInteger('item_id');
				$table->string('item_type');
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
		if (Schema::hasTable('item_galleries'))
		{
			Schema::drop('item_galleries');
		}
	}
}
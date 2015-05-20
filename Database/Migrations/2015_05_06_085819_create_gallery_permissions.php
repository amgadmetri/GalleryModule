<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryPermissions extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		foreach (\CMS::CoreModuleParts()->getModuleParts('gallery') as $modulePart) 
		{

			if ($modulePart->part_key === 'Thumbnails') 
			{
				\CMS::permissions()->insertDefaultItemPermissions(
					                 $modulePart->part_key, 
					                 $modulePart->id, 
					                 [
						                 'admin'   => ['resize', 'crop', 'delete'],
						                 'manager' => ['resize', 'crop']
					                 ]);
			}
			else
			{
				\CMS::permissions()->insertDefaultItemPermissions(
					                 $modulePart->part_key, 
					                 $modulePart->id, 
					                 [
						                 'admin'   => ['show', 'add', 'edit', 'delete'],
						                 'manager' => ['show', 'edit']
					                 ]);
			}
		}
	}

	/**
	 * Reverse the migration.
	 *
	 * @return void
	 */
	public function down()
	{
		foreach (\CMS::CoreModuleParts()->getModuleParts('gallery') as $modulePart) 
		{
			\CMS::permissions()->deleteItemPermissions($modulePart->part_key);
		}
	}
}
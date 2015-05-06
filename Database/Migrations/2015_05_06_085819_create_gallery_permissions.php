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
		foreach (\InstallationRepository::getModuleParts('gallery') as $modulePart) 
		{

			if ($modulePart->part_key === 'Thumbnails') 
			{
				\AclRepository::insertDefaultItemPermissions(
					$modulePart->part_key, 
					$modulePart->id, 
					[
					'admin'   => ['resize', 'crop', 'delete'],
					'manager' => ['resize', 'crop']
					]);
			}
			else
			{
				\AclRepository::insertDefaultItemPermissions(
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
		foreach (\InstallationRepository::getModuleParts('gallery') as $modulePart) 
		{
			\AclRepository::deleteItemPermissions($modulePart->part_key);
		}
	}
}
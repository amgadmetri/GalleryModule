<?php namespace App\Modules\Gallery\Repositories;

use App\Modules\Gallery\Traits\GalleryTrait;
use App\Modules\Gallery\Traits\AlbumsTrait;
use App\Modules\Gallery\Traits\ThumbnailsTrait;


class GalleryRepository
{
	use GalleryTrait;
	use AlbumsTrait;
	use ThumbnailsTrait;

	public function createDirIfNotExists($dirName)
	{
		$dirName = public_path() . '/uploads/' . $dirName . '/' . $this->getCurrentDateDirectory();
		if( ! file_exists($dirName) && ! is_dir($dirName)) 
		{
			mkdir($dirName, 0755, true);
		}
		return $dirName;
	}

	public function getCurrentDateDirectory()
	{
		return date("Y") . '/' . date("m") . '/';
	}
}

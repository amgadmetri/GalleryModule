<?php namespace App\Modules\Gallery\Repositories;

use App\Modules\Gallery\Traits\GalleryTrait;
use App\Modules\Gallery\Traits\AlbumsTrait;
use App\Modules\Gallery\Traits\ThumbnailsTrait;


class GalleryRepository
{
	use GalleryTrait;
	use AlbumsTrait;
	use ThumbnailsTrait;

	public function getMediaLibrary($type = 'all', $single = false)
	{
		switch ($type) 
		{
			case 'all': default :
				$galleries = $this->getAllGalleries();
				break;
			
			case 'photo':
				$galleries = $this->getAllGalleries('photo');
				break;

			case 'video':
				$galleries = $this->getAllGalleries('video');
				break;
		}
		
		return view('gallery::parts.modals.mediamodal', 
			        compact('galleries', 'single'))->
					render();
	}

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

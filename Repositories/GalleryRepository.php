<?php namespace App\Modules\Gallery\Repositories;

use App\Modules\Gallery\Traits\GalleryTrait;
use App\Modules\Gallery\Traits\AlbumsTrait;
use App\Modules\Gallery\Traits\ThumbnailsTrait;


class GalleryRepository
{
	use GalleryTrait;
	use AlbumsTrait;
	use ThumbnailsTrait;

	public function getMediaLibrary($type = 'all', $single = false, $medialibraryName = 'mediaLibrary', $paginate = false)
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

			case 'album':
				$galleries = false;
				$albums    = $this->getAllAlbums();
				break;
		}

		$single = $single === 'true' ? true : false;

		if( $type !== 'album')
			$galleries->setPath(url('gallery/medialibrary/paginate', [$type, $single ? 'true' : 'false', $medialibraryName]));
		else
			$albums->setPath(url('gallery/medialibrary/paginate', [$type, $single ? 'true' : 'false', $medialibraryName]));

		if($paginate)
			return view('gallery::parts.modals.modalgalleryblock', 
			        compact('galleries', 'albums', 'single', 'type', 'medialibraryName'))->
					render();
		else
			return view('gallery::parts.modals.mediamodal', 
			        compact('galleries', 'albums', 'single', 'type', 'medialibraryName'))->
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

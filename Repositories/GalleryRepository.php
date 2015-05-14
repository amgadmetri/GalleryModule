<?php namespace App\Modules\Gallery\Repositories;

use App\AbstractRepositories\AbstractRepository;
use App\Modules\Gallery\Gallery;

class GalleryRepository extends AbstractRepository
{
	protected function getModel()
	{
		return 'App\Modules\Gallery\Gallery';
	}

	protected function getRelations()
	{
		return ['albums', 'thumbnails'];
	}

	public function getMediaLibrary($type = 'all', $single = false, $medialibraryName = 'mediaLibrary', $perPage = 15)
	{
		$this->prepareMediaLibrary($type, $single, $medialibraryName, $perPage, $galleries, $albums);
		return view('gallery::parts.modals.mediamodal', 
			        compact('galleries', 'albums', 'single', 'type', 'medialibraryName'))->
					render();
	}

	public function paginateMediaLibrary($type = 'all', $single = false, $medialibraryName = 'mediaLibrary', $perPage = 15)
	{
		$this->prepareMediaLibrary($type, $single, $medialibraryName, $perPage, $galleries, $albums);
		return view('gallery::parts.modals.modalgalleryblock', 
			        compact('galleries', 'albums', 'single', 'type', 'medialibraryName'))->
					render();
	}

	public function prepareMediaLibrary($type, $single, $medialibraryName, $perPage, &$galleries, &$albums)
	{
		switch ($type) 
		{
			case 'album':
				$galleries = false;
				$albums    = \CMS::albums()->paginate($perPage);
				break;
			default:
				$galleries = $this->getAllGalleries($type, $perPage);
				break;
		}

		$single = $single === 'true' || $single === true ? true : false;

		if( $type !== 'album')
		{
			$galleries->setPath(url('admin/gallery/medialibrary/paginate', [$type, $single ? 'true' : 'false', $medialibraryName, $perPage]));
		}
		else
		{
			$albums->setPath(url('admin/gallery/medialibrary/paginate', [$type, $single ? 'true' : 'false', $medialibraryName, $perPage]));
		}
	}

	public function createDirIfNotExists($dirName)
	{
		$dirName = 'uploads/' . $dirName . '/' . $this->getCurrentDateDirectory();
		
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

	public function getAllGalleries($type = 'all', $perPage = 15)
	{
		switch ($type) 
		{
			case 'all' : default :
				return $this->paginate($perPage);
				break;
			
			case 'photo':
				return $this->paginateBy('type', 'photo',$perPage);
				break;

			case 'video':
				return $this->paginateBy('type', 'video',$perPage);
				break;
		}
	}

	public function getGalleries($ids)
	{
		return Gallery::with($this->getRelations())->whereIn('id', $ids)->get();
	}

	public function addGalleries($obj, $data)
	{
		$this->deleteGalleries($obj);
		return $this->addItemGalleries($obj, $data);
	}

	public function deleteGalleries($obj)
	{
		return $obj->galleries()->detach();
	}

	public function addItemGalleries($obj, $data)
	{
		return $obj->galleries()->attach($data);
	}

	public function deleteItemGallery($obj, $id)
	{
		return $obj->galleries()->detach($id);
	}

	public function uploadPhoto($file)
	{
		$fileName =  "img_" . uniqid() . time() . '_' . $file->getClientOriginalName();
		$file->move($this->createDirIfNotExists('images'), $fileName);

		return $this->getCurrentDateDirectory() . $fileName;
	}

	public function getVedioCode($url)
	{
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		return $my_array_of_vars['v'];
	}

	public function getImageThumbnail($galleryId, $thumbName = false)
	{
		if($gallery = $this->find($galleryId))
		{
			if ($thumbName)
			{
				if($thumb = $gallery->thumbnails()->where('thumb_name', '=', $thumbName)->first())
				{
					return $thumb;
				}
				return $gallery;
			}
			return $gallery->thumbnails;
		}
		return false;
	}
}

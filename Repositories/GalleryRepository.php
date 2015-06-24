<?php namespace App\Modules\Gallery\Repositories;

use App\AbstractRepositories\AbstractRepository;
use App\Modules\Gallery\Gallery;

class GalleryRepository extends AbstractRepository
{
	/**
	 * Return the model full namespace.
	 * 
	 * @return string
	 */
	protected function getModel()
	{
		return 'App\Modules\Gallery\Gallery';
	}

	/**
	 * Return the module relations.
	 * 
	 * @return array
	 */
	protected function getRelations()
	{
		return ['albums', 'thumbnails'];
	}

	/**
	 * Return the media library.
	 * 
	 * @param  string  $type             all, photo, video and album
	 * @param  string  $select           multi, single
	 * @param  string  $medialibraryName
	 * @param  integer $perPage
	 * @return string
	 */
	public function getMediaLibrary($type = 'all', $select = 'multi', $medialibraryName = 'mediaLibrary', $perPage = 15)
	{
		$this->prepareMediaLibrary($type, $select, $medialibraryName, $perPage, $galleries, $albums);
		return view('gallery::parts.modals.mediamodal', compact('galleries', 'albums', 'select', 'type', 'medialibraryName', 'perPage'))->render();
	}

	/**
	 * Handle the pagination of the media library.
	 * 
	 * @param  string  $type             all, photo, video and album
	 * @param  string  $select           multi, single
	 * @param  string  $medialibraryName
	 * @param  integer $perPage
	 * @return string
	 */	
	public function paginateMediaLibrary($type = 'all', $select = 'multi', $medialibraryName = 'mediaLibrary', $perPage = 15)
	{
		$this->prepareMediaLibrary($type, $select, $medialibraryName, $perPage, $galleries, $albums);
		return view('gallery::parts.modals.modalgalleryblock', compact('galleries', 'albums', 'select', 'type', 'medialibraryName', 'perPage'))->render();
	}

	/**
	 * Perpare the media library data.
	 * 
	 * @param  string      $type             all, photo, video and album
	 * @param  string      $select           multi, single
	 * @param  string      $medialibraryName
	 * @param  integer     $perPage
	 * @param  collection  &$galleries       contain the galleries data
	 * @param  collection  &$albums          contain the albums data
	 * @return void
	 */	
	public function prepareMediaLibrary($type, $select, $medialibraryName, $perPage, &$galleries, &$albums)
	{
		$galleries = false;
		$albums    = false;
		switch ($type) 
		{
			case 'album':
				$albums    = \CMS::albums()->paginate($perPage);
				break;
			default:
				$galleries = $this->getAllGalleries($type, $select, $medialibraryName, $perPage);
				break;
		}
	}

	/**
	 * Return all galleries based on the given inputs.
	 * 
	 * @param  string      $type             all, photo, video and album
	 * @param  string      $select           multi, single
	 * @param  string      $medialibraryName
	 * @param  integer     $perPage
	 * @return collection
	 */
	public function getAllGalleries($type = 'all', $select = 'multi', $medialibraryName = 'medialibrary', $perPage = 15)
	{
		switch ($type) 
		{
			case 'all' : default :
				$galleries = $this->paginate($perPage);
				break;
			
			case 'photo':
				$galleries = $this->paginateBy('type', 'photo',$perPage);
				break;

			case 'video':
				$galleries = $this->paginateBy('type', 'video',$perPage);
				break;
		}

		$galleries->setPath(url('admin/gallery/medialibrary/paginate', [$type, $select, $medialibraryName, $perPage]));
		return $galleries;
	}

	/**
	 * Return list of galleries with the given ids.
	 * 
	 * @param  integer $ids
	 * @return collection
	 */
	public function getGalleries($ids)
	{
		return $this->model->with($this->getRelations())->whereIn('id', $ids)->get();
	}

	/**
	 * Replace with the given list of galleries ids to
	 * the given object.
	 * 
	 * @param object $obj
	 * @param array  $data
	 * @return void
	 */
	public function addGalleries($obj, $data)
	{
		$this->deleteGalleries($obj);
		$this->addItemGalleries($obj, $data);
	}

	/**
	 * Delete all galleries from the given object.
	 * 
	 * @param  object $obj
	 * @return void
	 */
	public function deleteGalleries($obj)
	{
		$obj->galleries()->detach();
	}

	/**
	 * Assign the given list of galleries ids to
	 * the given object.
	 * 
	 * @param  object $obj
	 * @param  array  $data
	 * @return void
	 */
	public function addItemGalleries($obj, $data)
	{
		$obj->galleries()->attach($data);
	}

	/**
	 * Delete the given gallery id from 
	 * the given object.
	 * 
	 * @param  object  $obj
	 * @param  integer $id
	 * @return void
	 */
	public function deleteItemGallery($obj, $id)
	{
		$obj->galleries()->detach($id);
	}

	/**
	 * Upload the given file and return the path.
	 * 
	 * @param  file $file
	 * @return string
	 */
	public function uploadPhoto($file)
	{
		$fileName =  "img_" . uniqid() . time() . '_' . $file->getClientOriginalName();
		$file->move($this->createDirIfNotExists('images'), $fileName);

		return $this->getCurrentDateDirectory() . $fileName;
	}

	/**
	 * Return the video code from the given url.
	 * 
	 * @param  string $url
	 * @return string
	 */
	public function getVideoCode($url)
	{
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		return $my_array_of_vars['v'];
	}

	/**
	 * Return the image thumb if the thumb name is given
	 * or return all image thumbs.If the thumb not found
	 * then return the gallery.
	 * 
	 * @param  integer $galleryId
	 * @param  boolean $thumbName
	 * @return false if image not found , 
	 *         collection for all thumbs
	 *         or object for single thumb.
	 */
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

	/**
	 * Check the given dir and create it if
	 * not exists then return the dir name.
	 * @param  string $dirName
	 * @return string
	 */
	public function createDirIfNotExists($dirName)
	{
		$dirName = 'uploads/' . $dirName . '/' . $this->getCurrentDateDirectory();
		
		if( ! file_exists($dirName) && ! is_dir($dirName)) 
		{
			mkdir($dirName, 0755, true);
		}
		return $dirName;
	}

	/**
	 * Return string with the current year and month.
	 * 
	 * @return string
	 */
	public function getCurrentDateDirectory()
	{
		return date("Y") . '/' . date("m") . '/';
	}
}

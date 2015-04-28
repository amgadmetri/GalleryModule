<?php namespace App\Modules\Gallery\Traits;

use App\Modules\Gallery\Gallery;

trait GalleryTrait{

	public function getAllGalleries($type = 'all')
	{
		switch ($type) 
		{
			case 'all' : default :
				return Gallery::with(['albums', 'thumbnails'])->paginate('6');
				break;
			
			case 'photo':
				return Gallery::where('type', 'photo')->with(['albums', 'thumbnails'])->paginate('6');
				break;

			case 'video':
				return Gallery::where('type', 'video')->with(['albums', 'thumbnails'])->paginate('6');
				break;
		}
	}

	public function getGalleries($ids)
	{
		return Gallery::with(['thumbnails'])->whereIn('id', $ids)->get();
	}

	public function getGallery($id)
	{
		return Gallery::find($id);
	}

	public function createGallery($data)
	{
		return Gallery::create($data);
	}

	public function updatePhoto($id, $data)
	{
		$gallery = $this->getGallery($id);
		return $gallery->update($data);
	}

	public function deleteGallery($id)
	{	
		$gallery = $this->getGallery($id);
		if ($gallery->type =="photo") 
		{
			if (file_exists($gallery->storage_path)) unlink($gallery->storage_path);
		}

		return $gallery->delete();
	}

	public function addGalleries($obj, $data)
	{
		$this->deleteGalleries($obj);
		return $obj->galleries()->attach($data);
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
		if($gallery = $this->getGallery($galleryId))
		{
			if ($thumbName)
			{
				if($thumb = $gallery->thumbnails()->where('thumb_name', '=', $thumbName)->first())
				{
					return $thumb;
				}
				return $this->getGallery($galleryId);
			}
			return $this->getGallery($galleryId)->thumbnails;
		}
		return false;
	}
}
<?php namespace App\Modules\Gallery\Traits;

use App\Modules\Gallery\Thumbnail;
use Intervention\Image\Facades\Image;

trait ThumbnailsTrait{

	public function getAllThumbnails()
	{
		return Thumbnail::all();
	}

	public function getThumbnail($id)
	{
		return Thumbnail::find($id);
	}

	public function createThumbnail($data)
	{
		return Thumbnail::create($data);
	}

	public function deleteThumbnail($id)
	{	
		$thumbnail = $this->getThumbnail($id);
		if (file_exists($thumbnail->storage_path)) unlink($thumbnail->storage_path);

		return $thumbnail->delete();
	}


	public function createThumbPhoto($id, $data, $thumbType = 'resize')
	{
		$gallery = $this->getGallery($id);		
		$image   = Image::make($gallery->storage_path);

		if($thumbType == 'resize')
		{
			$croppedImage = $image->resize($data['width'], $data['height']);
		}
		else
		{
			$croppedImage = $image->crop($data['width'], $data['height'], $data['x'], $data['y']);
		}

		$croppedImage->save($this->createDirIfNotExists('thumbnails') . 
	                        $data['thumb_name'] . 
                            '_' . 
	                        $gallery->uploaded_file_name);

		$thumbnail = $this->createThumbnail(
			array_merge(
				$data, 
				['path' => $this->getCurrentDateDirectory() .
				           $data['thumb_name'] . 
				           '_' . 
				           $gallery->uploaded_file_name
				]));
		
		$gallery->thumbnails()->save($thumbnail);
	}
}
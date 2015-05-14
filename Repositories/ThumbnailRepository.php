<?php namespace App\Modules\Gallery\Repositories;

use App\AbstractRepositories\AbstractRepository;
use Intervention\Image\Facades\Image;
use App\Modules\Gallery\Thumbnail;

class ThumbnailRepository extends AbstractRepository
{
	protected function getModel()
	{
		return 'App\Modules\Gallery\Thumbnail';
	}

	protected function getRelations()
	{
		return ['gallery'];
	}

	public function createThumbPhoto($id, $data, $thumbType = 'resize')
	{
		$gallery = \CMS::galleries()->find($id);		
		$image   = Image::make($gallery->storage_path);

		if($thumbType == 'resize')
		{
			$croppedImage = $image->resize($data['width'], $data['height']);
		}
		else
		{
			$croppedImage = $image->crop($data['width'], $data['height'], $data['x'], $data['y']);
		}

		$croppedImage->save(\CMS::galleries()->createDirIfNotExists('thumbnails') . 
	                        $data['thumb_name'] . '_' . $gallery->uploaded_file_name);

		$thumbnail = new Thumbnail(
			array_merge(
				$data, 
				[
					'path' => \CMS::galleries()->getCurrentDateDirectory() .
					$data['thumb_name'] . '_' . $gallery->uploaded_file_name
				])
			);
		
		$gallery->thumbnails()->save($thumbnail);
	}
}

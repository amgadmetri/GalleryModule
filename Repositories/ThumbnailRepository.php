<?php namespace App\Modules\Gallery\Repositories;

use App\Modules\Core\AbstractRepositories\AbstractRepository;
use Intervention\Image\Facades\Image;

class ThumbnailRepository extends AbstractRepository
{
	/**
	 * Return the model full namespace.
	 * 
	 * @return string
	 */
	protected function getModel()
	{
		return 'App\Modules\Gallery\Thumbnail';
	}

	/**
	 * Return the module relations.
	 * 
	 * @return array
	 */
	protected function getRelations()
	{
		return ['gallery'];
	}

	/**
	 * Create thumbnail based on the given thumb type , 
	 * resize or crop with the given data.
	 * 
	 * @param  integer $id
	 * @param  array   $data
	 * @param  string  $thumbType
	 * @return void
	 */
	public function createThumbPhoto($id, $data, $thumbType = 'resize')
	{
		$gallery = \CMS::galleries()->find($id);		
		$image   = Image::make($gallery->storage_path);

		if($thumbType == 'resize')
		{
			$thumbImage = $image->resize($data['width'], $data['height']);
		}
		else
		{
			$thumbImage = $image->crop($data['width'], $data['height'], $data['x'], $data['y']);
		}

		$thumbImage->save(\CMS::galleries()->createDirIfNotExists('thumbnails') . $data['thumb_name'] . '_' . $gallery->uploaded_file_name);
		$thumbnail = new $this->model(
			array_merge(
				$data, 
				[
					'path' => \CMS::galleries()->getCurrentDateDirectory() . $data['thumb_name'] . '_' . $gallery->uploaded_file_name
				])
			);
		
		$gallery->thumbnails()->save($thumbnail);
	}
}

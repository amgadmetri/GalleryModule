<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gallery\Repositories\GalleryRepository;

use Illuminate\Http\Request;

class MediaLibraryController extends Controller {
	
	private $gallery;
	public function __construct(GalleryRepository $gallery)
	{
		$this->gallery = $gallery;
	}

	public function getPaginate($type = 'all', $single = false, $medialibraryName = 'mediaLibrary')
	{
		return $this->gallery->getMediaLibrary($type, $single, $medialibraryName, true);
	}
}
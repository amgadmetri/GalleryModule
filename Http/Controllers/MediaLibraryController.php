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

	public function getIndex(Request $request)
	{
		$galleries = $this->gallery->getAllGalleries();
		$galleries->setPath('medialibrary');

		$galleryBlock = view('gallery::parts.modals.modalgalleryblock', compact('galleries'))->render();

		if ($request->ajax()) return $galleryBlock;
		return view('gallery::medialibrary.medialibrary' ,compact('galleryBlock', 'galleries'));
	}	
}
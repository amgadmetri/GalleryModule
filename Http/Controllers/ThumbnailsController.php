<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Modules\Gallery\Http\Requests\ResizeFormRequest;
use App\Modules\Gallery\Http\Requests\CropFormRequest;

use App\Modules\Gallery\Repositories\GalleryRepository;

class ThumbnailsController extends Controller {
	
	private $gallery;
	public function __construct(GalleryRepository $gallery)
	{
		$this->middleware('AclAuthenticate');
		$this->gallery = $gallery;
	}

	public function postResize(ResizeFormRequest $request, $id)
	{
		$this->gallery->createThumbPhoto($id, $request->all());
		return redirect()->back()->with('message', 'Photo uploaded succssefuly');
	}

	public function postCrop(CropFormRequest $request, $id)
	{
		$this->gallery->createThumbPhoto($id, $request->all(), 'crop');
		return redirect()->back()->with('message', 'Photo uploaded succssefuly');
	}
	
	public function getDelete($id)
	{	
		$this->gallery->deleteThumbnail($id);
		return redirect()->back();

	}
}
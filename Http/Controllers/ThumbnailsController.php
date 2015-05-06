<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Gallery\Http\Requests\ResizeFormRequest;
use App\Modules\Gallery\Http\Requests\CropFormRequest;
use App\Modules\Gallery\Repositories\GalleryRepository;

class ThumbnailsController extends BaseController {
	
	public function __construct(GalleryRepository $gallery)
	{
		parent::__construct($gallery, 'Thumbnails');
	}

	public function postResize(ResizeFormRequest $request, $id)
	{
		$this->hasPermission('resize');
		$this->repository->createThumbPhoto($id, $request->all());

		return redirect()->back()->with('message', 'Photo uploaded succssefuly');
	}

	public function postCrop(CropFormRequest $request, $id)
	{
		$this->hasPermission('crop');
		$this->repository->createThumbPhoto($id, $request->all(), 'crop');

		return redirect()->back()->with('message', 'Photo uploaded succssefuly');
	}
	
	public function getDelete($id)
	{	
		$this->hasPermission('delete');
		$this->repository->deleteThumbnail($id);
		
		return redirect()->back();

	}
}
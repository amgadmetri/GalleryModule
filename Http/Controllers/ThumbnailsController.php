<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Gallery\Http\Requests\ResizeFormRequest;
use App\Modules\Gallery\Http\Requests\CropFormRequest;

class ThumbnailsController extends BaseController {
	
	public function __construct()
	{
		parent::__construct('Thumbnails');
	}

	public function postResize(ResizeFormRequest $request, $id)
	{
		$this->hasPermission('resize');
		\CMS::thumbnails()->createThumbPhoto($id, $request->all());

		return redirect()->back()->with('message', 'Photo uploaded succssefuly');
	}

	public function postCrop(CropFormRequest $request, $id)
	{
		$this->hasPermission('crop');
		\CMS::thumbnails()->createThumbPhoto($id, $request->all(), 'crop');

		return redirect()->back()->with('message', 'Photo uploaded succssefuly');
	}
	
	public function getDelete($id)
	{	
		$this->hasPermission('delete');
		\CMS::thumbnails()->delete($id);
		
		return redirect()->back();

	}
}
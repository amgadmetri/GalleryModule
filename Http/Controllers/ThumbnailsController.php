<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Gallery\Http\Requests\ResizeFormRequest;
use App\Modules\Gallery\Http\Requests\CropFormRequest;

class ThumbnailsController extends BaseController {
	
	/**
	 * Specify a list of extra permissions.
	 * 
	 * @var permissions
	 */
	protected $permissions = [
	'postResize' => 'resize',
	'postCrop'   => 'crop',
	];

	/**
	 * Create new ThumbnailsController instance.
	 */
	public function __construct()
	{
		parent::__construct('Thumbnails');
	}

	/**
	 * Create resized thumbnail from the specified photo.
	 * 
	 * @param  ResizeFormRequest $request
	 * @param  integer           $id
	 * @return response
	 */
	public function postResize(ResizeFormRequest $request, $id)
	{
		\CMS::thumbnails()->createThumbPhoto($id, $request->all());
		return redirect()->back()->with('message', 'Photo resized succssefuly');
	}

	/**
	 * Create cropped thumbnail from the specified photo.
	 * 
	 * @param  CropFormRequest $request
	 * @param  integer           $id
	 * @return response
	 */
	public function postCrop(CropFormRequest $request, $id)
	{
		\CMS::thumbnails()->createThumbPhoto($id, $request->all(), 'crop');
		return redirect()->back()->with('message', 'Photo cropped succssefuly');
	}
	
	/**
	 * Remove the specified thumbnail from storage.
	 * 
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id)
	{	
		\CMS::thumbnails()->delete($id);
		return redirect()->back();

	}
}
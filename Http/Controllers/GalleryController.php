<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Gallery\Http\Requests\VideoFormRequest;
use App\Modules\Gallery\Http\Requests\PhotoFormRequest;

 class GalleryController extends BaseController {
	
	/**
	 * Specify a list of extra permissions.
	 * 
	 * @var permissions
	 */
	protected $permissions = [
	'postCreatephoto' => 'add',
	'postCreatevideo' => 'add',
	];

	/**
	 * Create new GalleryController instance.
	 */
 	public function __construct()
	{
		parent::__construct('Galleries');
	}

 	/**
	 * Display a listing of the galleries.
	 * 
	 * @return Response
	 */
	public function getIndex()
	{
		$galleries = \CMS::galleries()->getAllGalleries('all', 3);
		$galleries->setPath(url('admin/gallery'));

		return view('gallery::galleries.viewgallery', compact('galleries'));
	}

	/**
	 * Display a specified gallery.
	 * 
	 * @param  integer $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$gallery = \CMS::galleries()->find($id);
		return view('gallery::galleries.preview' ,compact('gallery'));
	}
	
	/**
	 * Store a newly created gallery of 
	 * type photo in storage.
	 * 
	 * @param  PhotoFormRequest  $request
	 * @return Response
	 */
	public function postCreatephoto(PhotoFormRequest $request)
	{
		$data['user_id'] = \Auth::user()->id;
		$data['path']    = \CMS::galleries()->uploadPhoto($request->file('image'));
		$gallery         = \CMS::galleries()->create(array_merge($request->except('path'), $data));

		/**
		 * If the request is ajax then get the necessary data 
		 * for returning the gallery template html.
		 */
		if ($request->ajax())
		{
			$select           = $request->input('select');
			$type             = $request->input('mediaType');
			$perPage          = $request->input('perPage');
			$medialibraryName = $request->input('medialibraryName');
			$galleries        = \CMS::galleries()->getAllGalleries($type, $select, $medialibraryName, $perPage);

			return view('gallery::parts.modals.modalgalleryblock', compact('galleries', 'select', 'medialibraryName'))->render();
		}

		return redirect()->back()->with('message', 'Photo created succssefuly');
	}

	/**
	 * Store a newly created gallery of 
	 * type video in storage.
	 * 
	 * @param  VideoFormRequest  $request
	 * @return Response
	 */
	public function postCreatevideo(VideoFormRequest $request)
	{
		$data['user_id'] = \Auth::user()->id;
		$data['path']    = \CMS::galleries()->getVideoCode($request->input('path'));
		$gallery         = \CMS::galleries()->create(array_merge($request->except('path'), $data));

		/**
		 * If the request is ajax then get the necessary data 
		 * for returning the gallery template html.
		 */
		if ($request->ajax()) 
		{
			$select           = $request->input('select');
			$type             = $request->input('mediaType');
			$perPage          = $request->input('perPage');
			$medialibraryName = $request->input('medialibraryName');
			$galleries        = \CMS::galleries()->getAllGalleries($type, $select, $medialibraryName, $perPage);

			return view('gallery::parts.modals.modalgalleryblock', compact('galleries', 'select', 'medialibraryName'))->render();
		}

		return redirect()->back()->with('message', 'Video created succssefuly');
	}

	/**
	 * Show the form for editing the specified gallery.
	 * 
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$gallery = \CMS::galleries()->find($id);
		return view('gallery::galleries.updategallery', compact('gallery'));
	}
	
	/**
	 * Update the specified gallery in storage.
	 * 
	 * @param  int  $id
	 * @param  VideoFormRequest  $request
	 * @return Response
	 */
	public function postEdit($id, VideoFormRequest $request)
	{
		\CMS::galleries()->update($id, $request->only('file_name', 'caption', 'album_id'));
		return redirect()->back()->with('message', 'Photo updated succssefuly');
	}

	/**
	 * Remove the specified gallery from storage.
	 * 
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id)
	{
		\CMS::galleries()->delete($id);
		return redirect()->back()->with('message', 'Gallery deleted succssefuly');
	}
}
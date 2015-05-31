<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Gallery\Http\Requests\AlbumFormRequest;
use Illuminate\Http\Request;

class AlbumController extends BaseController {
	
	/**
	 * Specify a list of extra permissions.
	 * 
	 * @var permissions
	 */
	protected $permissions = [
	'getShow'               => 'show',
	'getEditalbumgalleries' => 'edit',
	'getAddalbumgalleries'  => 'add',
	'getDeletegallery'      => 'edit',
	];

	/**
	 * Create new AlbumController instance.
	 */
	public function __construct()
	{
		parent::__construct('Albums');
	}

	/**
	 * Display a listing of the albums.
	 * 
	 * @return Response
	 */
	public function getIndex()
	{
		$albums = \CMS::albums()->paginate(6);
		$albums->setPath('album');
		
		return view('gallery::albums.viewalbum', compact('albums'));
	}

	/**
	 * Display a specified album.
	 * 
	 * @param  integer $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$album          = \CMS::albums()->find($id);
		$albumGalleries = \CMS::galleries()->getGalleries($album->galleries->lists('id'));	
		$mediaLibrary   = \CMS::galleries()->getMediaLibrary();

		return view('gallery::albums.preview' ,compact('album', 'albumGalleries', 'mediaLibrary'));
	}

	/**
	 * Show the form for creating a new album.
	 * 
	 * @return Response
	 */
	public function getCreate()
	{	
		$mediaLibrary = \CMS::galleries()->getMediaLibrary('all', 'multi', 'mediaLibrary', 1);
		return view('gallery::albums.addalbum', compact('mediaLibrary'));
	}

	/**
	 * Store a newly created album in storage.
	 * 
	 * @param  AlbumFormRequest  $request
	 * @return Response
	 */
	public function postCreate(AlbumFormRequest $request)
	{
		$data['user_id'] = \Auth::user()->id;
		$album           = \CMS::albums()->create(array_merge($request->all(), $data));
		\CMS::galleries()->addGalleries($album, $request->input('gallery_ids'));

		return redirect()->back()->with('message', 'Album Created succssefuly');
	}
	
	/**
	 * Show the form for editing the specified album.
	 * 
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$album          = \CMS::albums()->find($id);
		$mediaLibrary   = \CMS::galleries()->getMediaLibrary();
		$albumGalleries = \CMS::galleries()->getGalleries($album->galleries->lists('id'));
		$albumGalleries = view('gallery::parts.gallery.galleryblock', ['insertedGalleries' => $albumGalleries])->render();
		
		return view('gallery::albums.updatealbum', compact('album', 'mediaLibrary', 'albumGalleries'));
	}
		
	/**
	 * Update the specified album in storage.
	 * 
	 * @param  int  $id
	 * @param  AlbumFormRequest  $request
	 * @return Response
	 */
	public function postEdit($id, AlbumFormRequest $request)
	{
		$album = \CMS::albums()->update($id, $request->all());
		\CMS::galleries()->addGalleries($album, $request->input('gallery_ids'));

		return redirect()->back()->with('message', 'Album updated succssefuly');
	}
	
	/**
	 * Remove the specified album from storage.
	 * 
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id)
	{
		\CMS::albums()->delete($id);
		return redirect()->back()->with('message', 'album Deleted succssefuly');
	}

	/**
	 * Remove a specified gallery from a specified album.
	 * 
	 * @param  integer $galleryId
	 * @param  integer $albumId
	 * @return Response
	 */
	public function getDeletegallery($galleryId, $albumId)
	{
		\CMS::galleries()->deleteItemGallery(\CMS::albums()->find($albumId), $galleryId);
		return redirect()->back()->with('message', 'Gallery deleted succssefuly');
	}

	/**
	 * Add the selected galleries to a specified album.
	 * 
	 * @param  Request $request
	 * @return Response
	 */
	public function getEditalbumgalleries($id, Request $request)
	{
		\CMS::galleries()->addItemGalleries(\CMS::albums()->find($id), $request->input('ids'));
		return redirect()->back()->with('message', 'Album updated succssefuly');
	}

	/**
	 * Return a gallery array from the given ids,
	 * handle the ajax request for inserting galleries
	 * to the album.
	 *
	 * @param  Request $request
	 * @return Response
	 */
	public function getAddalbumgalleries(Request $request)
	{
		$insertedGalleries = \CMS::galleries()->getGalleries($request->input('ids'));
		return view('gallery::parts.gallery.galleryblock', compact('insertedGalleries'))->render();
	}
}

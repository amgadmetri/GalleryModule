<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Gallery\Http\Requests\AlbumFormRequest;
use Illuminate\Http\Request;

class AlbumController extends BaseController {
	
	
	public function __construct()
	{
		parent::__construct('Albums');
	}

	public function getIndex()
	{
		$this->hasPermission('show');
		$albums = \CMS::albums()->paginate(6);
		$albums->setPath('album');
		
		return view('gallery::albums.viewalbum', compact('albums'));
	}

	public function getPreview($id, Request $request)
	{
		$this->hasPermission('show');
		if($request->ajax()) 
		{
			$this->hasPermission('edit');
			\CMS::galleries()->addItemGalleries(\CMS::albums()->find($id), $request->input('ids'));
			return 'refresh';
		}
		
		$album          = \CMS::albums()->find($id);
		$albumGalleries = \CMS::galleries()->getGalleries($album->galleries->lists('id'));	
		$mediaLibrary   = \CMS::galleries()->getMediaLibrary();

		return view('gallery::albums.preview' ,compact('album', 'albumGalleries', 'mediaLibrary'));
	}

	public function getCreate(Request $request)
	{	
		$this->hasPermission('add');
		if($request->ajax()) 
		{
			$insertedGalleries = \CMS::galleries()->getGalleries($request->input('ids'));
			return view('gallery::parts.gallery.galleryblock', compact('insertedGalleries'))->render();
		}

		$mediaLibrary = \CMS::galleries()->getMediaLibrary();
		return view('gallery::albums.addalbum', compact('mediaLibrary'));
	}

	public function postCreate(AlbumFormRequest $request)
	{
		$this->hasPermission('add');
		$data['user_id'] = \Auth::user()->id;
		$album           = \CMS::albums()->create(array_merge($request->all(), $data));
		\CMS::galleries()->addGalleries($album, $request->input('gallery_ids'));

		return redirect()->back()->with('message', 'Album Created succssefuly');
	}
	
	public function getUpdate($id, Request $request)
	{
		$this->hasPermission('edit');
		if($request->ajax()) 
		{
			$insertedGalleries = \CMS::galleries()->getGalleries($request->input('ids'));
			return view('gallery::parts.gallery.galleryblock', compact('insertedGalleries'))->render();
		}

		$album             = \CMS::albums()->find($id);
		$mediaLibrary      = \CMS::galleries()->getMediaLibrary();
		
		$albumGalleriesIds = \CMS::galleries()->getGalleries($album->galleries->lists('id'));
		$albumGalleries    = view('gallery::parts.gallery.galleryblock', ['insertedGalleries' => $albumGalleriesIds])->render();
		

		return view('gallery::albums.updatealbum', compact('album', 'mediaLibrary', 'albumGalleries'));
	}
	
	public function postUpdate(AlbumFormRequest $request, $id)
	{
		$this->hasPermission('edit');
		$data['user_id'] = \Auth::user()->id;
		$album           = \CMS::albums()->update($id, array_merge($request->all(), $data));
		\CMS::galleries()->addGalleries($album, $request->input('gallery_ids'));

		return redirect()->back()->with('message', 'Album updated succssefuly');
	}
	
	public function getDelete($id)
	{
		$this->hasPermission('delete');
		\CMS::albums()->delete($id);
		
		return redirect()->back()->with('message', 'album Deleted succssefuly');
	}

	public function getDeletegallery($galleryId, $albumId)
	{
		$this->hasPermission('edit');
		\CMS::galleries()->deleteItemGallery(\CMS::albums()->find($albumId), $galleryId);

		return redirect()->back()->with('message', 'Gallery Deleted succssefuly');
	}
}

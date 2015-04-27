<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gallery\Http\Requests\AlbumFormRequest;
use App\Modules\Gallery\Repositories\GalleryRepository;
use Illuminate\Http\Request;

class AlbumController extends Controller {
	
	
	private $gallery;
	public function __construct(GalleryRepository $gallery)
	{
		$this->middleware('AclAuthenticate');
		$this->gallery = $gallery;
	}

	public function getIndex()
	{
		$albums = $this->gallery->getAllAlbums();
		$albums->setPath('album');
		
		return view('gallery::albums.viewalbum', compact('albums'));
	}

	public function getPreview($id, Request $request)
	{
		if($request->ajax()) 
		{
			$this->gallery->addItemGalleries($this->gallery->getAlbum($id), $request->input('ids'));
			return 'refresh';
		}
		
		$album          = $this->gallery->getAlbum($id);
		$albumGalleries = $this->gallery->getGalleries($album->galleries->lists('id'));	
		$mediaLibrary   = $this->gallery->getMediaLibrary();

		return view('gallery::albums.preview' ,compact('album', 'albumGalleries', 'mediaLibrary'));
	}

	public function getCreate(Request $request)
	{	
		if($request->ajax()) 
		{
			$insertedGalleries = $this->gallery->getGalleries($request->input('ids'));
			return view('gallery::parts.gallery.galleryblock', compact('insertedGalleries'))->render();
		}

		$mediaLibrary = $this->gallery->getMediaLibrary();
		return view('gallery::albums.addalbum', compact('mediaLibrary'));
	}

	public function postCreate(AlbumFormRequest $request)
	{
		$data['user_id'] = \Auth::user()->id;
		$album           = $this->gallery->createAlbum(array_merge($request->all(), $data));
		$this->gallery->addGalleries($album, $request->input('gallery_ids'));

		return redirect()->back()->with('message', 'Album Created succssefuly');
	}
	
	public function getUpdate($id, Request $request)
	{
		if($request->ajax()) 
		{
			$insertedGalleries = $this->gallery->getGalleries($request->input('ids'));
			return view('gallery::parts.gallery.galleryblock', compact('insertedGalleries'))->render();
		}

		$album             = $this->gallery->getAlbum($id);
		$mediaLibrary      = $this->gallery->getMediaLibrary();
		
		$albumGalleriesIds = $this->gallery->getGalleries($album->galleries->lists('id'));
		$albumGalleries    = view('gallery::parts.gallery.galleryblock', ['insertedGalleries' => $albumGalleriesIds])->render();
		

		return view('gallery::albums.updatealbum', compact('album', 'mediaLibrary', 'albumGalleries'));
	}
	
	public function postUpdate(AlbumFormRequest $request, $id)
	{
		$data['user_id'] = \Auth::user()->id;
		$album           = $this->gallery->updateAlbum($id, array_merge($request->all(), $data));
		$this->gallery->addGalleries($album, $request->input('gallery_ids'));

		return redirect()->back()->with('message', 'Album updated succssefuly');
	}
	
	public function getDelete($id)
	{
		$this->gallery->deleteAlbum($id);
		return redirect()->back()->with('message', 'album Deleted succssefuly');
	}

	public function getDeletegallery($galleryId, $albumId)
	{
		$this->gallery->deleteItemGallery($this->gallery->getAlbum($albumId), $galleryId);
		return redirect()->back()->with('message', 'Gallery Deleted succssefuly');
	}
}

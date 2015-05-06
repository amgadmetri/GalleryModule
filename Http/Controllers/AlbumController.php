<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Gallery\Http\Requests\AlbumFormRequest;
use App\Modules\Gallery\Repositories\GalleryRepository;
use Illuminate\Http\Request;

class AlbumController extends BaseController {
	
	
	public function __construct(GalleryRepository $gallery)
	{
		parent::__construct($gallery, 'Albums');
	}

	public function getIndex()
	{
		$this->hasPermission('show');
		$albums = $this->repository->getAllAlbums();
		$albums->setPath('album');
		
		return view('gallery::albums.viewalbum', compact('albums'));
	}

	public function getPreview($id, Request $request)
	{
		$this->hasPermission('show');
		if($request->ajax()) 
		{
			$this->hasPermission('edit');
			$this->repository->addItemGalleries($this->repository->getAlbum($id), $request->input('ids'));
			return 'refresh';
		}
		
		$album          = $this->repository->getAlbum($id);
		$albumGalleries = $this->repository->getGalleries($album->galleries->lists('id'));	
		$mediaLibrary   = $this->repository->getMediaLibrary();

		return view('gallery::albums.preview' ,compact('album', 'albumGalleries', 'mediaLibrary'));
	}

	public function getCreate(Request $request)
	{	
		$this->hasPermission('add');
		if($request->ajax()) 
		{
			$insertedGalleries = $this->repository->getGalleries($request->input('ids'));
			return view('gallery::parts.gallery.galleryblock', compact('insertedGalleries'))->render();
		}

		$mediaLibrary = $this->repository->getMediaLibrary();
		return view('gallery::albums.addalbum', compact('mediaLibrary'));
	}

	public function postCreate(AlbumFormRequest $request)
	{
		$this->hasPermission('add');
		$data['user_id'] = \Auth::user()->id;
		$album           = $this->repository->createAlbum(array_merge($request->all(), $data));
		$this->repository->addGalleries($album, $request->input('gallery_ids'));

		return redirect()->back()->with('message', 'Album Created succssefuly');
	}
	
	public function getUpdate($id, Request $request)
	{
		$this->hasPermission('edit');
		if($request->ajax()) 
		{
			$insertedGalleries = $this->repository->getGalleries($request->input('ids'));
			return view('gallery::parts.gallery.galleryblock', compact('insertedGalleries'))->render();
		}

		$album             = $this->repository->getAlbum($id);
		$mediaLibrary      = $this->repository->getMediaLibrary();
		
		$albumGalleriesIds = $this->repository->getGalleries($album->galleries->lists('id'));
		$albumGalleries    = view('gallery::parts.gallery.galleryblock', ['insertedGalleries' => $albumGalleriesIds])->render();
		

		return view('gallery::albums.updatealbum', compact('album', 'mediaLibrary', 'albumGalleries'));
	}
	
	public function postUpdate(AlbumFormRequest $request, $id)
	{
		$this->hasPermission('edit');
		$data['user_id'] = \Auth::user()->id;
		$album           = $this->repository->updateAlbum($id, array_merge($request->all(), $data));
		$this->repository->addGalleries($album, $request->input('gallery_ids'));

		return redirect()->back()->with('message', 'Album updated succssefuly');
	}
	
	public function getDelete($id)
	{
		$this->hasPermission('delete');
		$this->repository->deleteAlbum($id);
		
		return redirect()->back()->with('message', 'album Deleted succssefuly');
	}

	public function getDeletegallery($galleryId, $albumId)
	{
		$this->hasPermission('edit');
		$this->repository->deleteItemGallery($this->repository->getAlbum($albumId), $galleryId);

		return redirect()->back()->with('message', 'Gallery Deleted succssefuly');
	}
}

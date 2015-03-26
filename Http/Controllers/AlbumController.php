<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gallery\Http\Requests\AlbumFormRequest;
use App\Modules\Gallery\Repositories\GalleryRepository;

use Illuminate\Http\Request;
class AlbumController extends Controller {
	
	
	private $gallery;
	public function __construct(GalleryRepository $gallery)
	{
		$this->gallery = $gallery;
	}

	public function getIndex()
	{
		$albums = $this->gallery->getAllAlbums();		
		return view('gallery::albums.viewalbum', compact('albums'));
	}

	public function getCreate(Request $request)
	{	
		if($request->ajax()) 
		{
			$insertedGalleries = $this->gallery->getGalleries($request->input('ids'));
			return view('gallery::parts.gallery.galleryblock', compact('insertedGalleries'))->render();
		}

		$galleries    = $this->gallery->getAllGalleries();
		$galleryBlock = view('gallery::parts.modals.modalgalleryblock', compact('galleries'))->render();
		
		return view('gallery::albums.addalbum', compact('galleries', 'galleryBlock'));
	}

	public function postCreate(AlbumFormRequest $request)
	{
		$data['user_id'] = 1;
		$this->gallery->createAlbum(array_merge($request->all(), $data));

		return redirect()->back()->with('message', 'Album Created succssefuly');
	}
	
	public function getUpdate($id)
	{
		$album = $this->gallery->getAlbum($id);
		return view('gallery::albums.updatealbum', compact('album'));
	}
	
	public function postUpdate(AlbumFormRequest $request, $id)
	{
		$data['user_id'] = 1;
		$this->gallery->updateAlbum($id, array_merge($request->all(), $data));

		return redirect()->back()->with('message', 'Album updated succssefuly');
	}
	
	public function getDelete($id)
	{
		$this->gallery->deleteAlbum($id);
		return redirect()->back()->with('message', 'album Deleted succssefuly');
	}
}
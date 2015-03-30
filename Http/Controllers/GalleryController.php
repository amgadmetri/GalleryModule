<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Gallery\Http\Requests\GalleryFormRequest;
use App\Modules\Gallery\Http\Requests\CropFormRequest;
use App\Modules\Gallery\Repositories\GalleryRepository;

 class GalleryController extends Controller {
	
	
 	private $gallery;
 	public function __construct(GalleryRepository $gallery)
 	{
 		$this->gallery = $gallery;
 	}

 	//display all the galleries
	public function getIndex()
	{
		$galleries = $this->gallery->getAllGalleries();
		$galleries->setPath('gallery');

		return view('gallery::galleries.viewgallery', compact('galleries'));
	}

	public function getPreview($id)
	{
		$gallery = $this->gallery->getGallery($id);
		return view('gallery::galleries.preview' ,compact('gallery'));
	}
	
	//insert the photo in the database
	public function postCreatephoto(GalleryFormRequest $request)
	{
		if ( ! $request->file())
		{
			return redirect()->back()->withInput()->with('message', '**Please attach the image file**');
		}

		$data['user_id'] = 1;
		$data['path']    = $this->gallery->uploadPhoto($request->file('image'));
		$gallery         = $this->gallery->createGallery(array_merge($request->except('path'), $data));

		if ($request->ajax())
		{
			$galleries = $this->gallery->getAllGalleries();
			$galleries->setPath('medialibrary');

			return view('gallery::parts.modals.modalgalleryblock', compact('galleries'))->render();
		}

		return redirect()->back()->with('message', 'Photo uploaded succssefuly');
	}

	public function postCreatevideo(GalleryFormRequest $request)
	{
		$data['user_id'] = 1;
		$data['path']    = $this->gallery->getVedioCode($request->input('path'));
		$gallery         = $this->gallery->createGallery(array_merge($request->except('path'), $data));

		if ($request->ajax()) 
		{
			$galleries = $this->gallery->getAllGalleries();
			$galleries->setPath('medialibrary');

			 return view('gallery::parts.modals.modalgalleryblock', compact('galleries'))->render();
		}

		return redirect()->back()->with('message', 'Video inserted in the database succssefuly');
	}

	//display the update form for photos
	public function getUpdategallery($id)
	{
		$gallery = $this->gallery->getGallery($id);
		return view('gallery::galleries.updategallery', compact('gallery'));
	}
	

	public function postUpdategallery(GalleryFormRequest $request, $id)
	{
		$data['user_id'] = 1;
		$this->gallery->updatePhoto(
			$id, 
			array_merge($request->only('file_name', 'caption', 'album_id'), $data)
			);
	
		return redirect()->back()->with('message', 'Photo updated succssefuly');
	}

	//Delete the gallery
	public function getDelete($id)
	{
		$this->gallery->deleteGallery($id);
		return redirect()->back()->with('message', 'gallery Deleted succssefuly');
	}
}
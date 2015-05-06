<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Gallery\Http\Requests\GalleryFormRequest;
use App\Modules\Gallery\Http\Requests\CropFormRequest;
use App\Modules\Gallery\Repositories\GalleryRepository;

 class GalleryController extends BaseController {
	
	
 	public function __construct(GalleryRepository $gallery)
	{
		parent::__construct($gallery, 'Galleries');
	}

 	//display all the galleries
	public function getIndex()
	{
		$this->hasPermission('show');
		$galleries = $this->repository->getAllGalleries();
		$galleries->setPath('gallery');

		return view('gallery::galleries.viewgallery', compact('galleries'));
	}

	public function getPreview($id)
	{
		$this->hasPermission('show');
		$gallery = $this->repository->getGallery($id);
		return view('gallery::galleries.preview' ,compact('gallery'));
	}
	
	//insert the photo in the database
	public function postCreatephoto(GalleryFormRequest $request)
	{
		$this->hasPermission('add');
		if ( ! $request->file())
		{
			return redirect()->back()->withInput()->with('message', '**Please attach the image file**');
		}

		$data['user_id'] = \Auth::user()->id;
		$data['path']    = $this->repository->uploadPhoto($request->file('image'));
		$gallery         = $this->repository->createGallery(array_merge($request->except('path'), $data));

		if ($request->ajax())
		{
			$single           = $request->input('single') === 'true' ? true : false;
			$mediaType        = $request->input('mediaType');
			$medialibraryName = $request->input('medialibraryName');
			
			$galleries        = $this->repository->getAllGalleries();
			$galleries->setPath(url('gallery/medialibrary/paginate', [$mediaType, $request->input('single')]));

			return view('gallery::parts.modals.modalgalleryblock', compact('galleries', 'single', 'medialibraryName'))->render();
		}

		return redirect()->back()->with('message', 'Photo uploaded succssefuly');
	}

	public function postCreatevideo(GalleryFormRequest $request)
	{
		$this->hasPermission('add');
		$data['user_id'] = \Auth::user()->id;
		$data['path']    = $this->repository->getVedioCode($request->input('path'));
		$gallery         = $this->repository->createGallery(array_merge($request->except('path'), $data));

		if ($request->ajax()) 
		{
			$single           = $request->input('single') === 'true' ? true : false;
			$mediaType        = $request->input('mediaType');
			$medialibraryName = $request->input('medialibraryName');
			
			$galleries        = $this->repository->getAllGalleries();
			$galleries->setPath(url('gallery/medialibrary/paginate', [$mediaType, $request->input('single')]));

			return view('gallery::parts.modals.modalgalleryblock', compact('galleries', 'single', 'medialibraryName'))->render();
		}

		return redirect()->back()->with('message', 'Video inserted in the database succssefuly');
	}

	//display the update form for photos
	public function getUpdategallery($id)
	{
		$this->hasPermission('edit');
		$gallery = $this->repository->getGallery($id);

		return view('gallery::galleries.updategallery', compact('gallery'));
	}
	

	public function postUpdategallery(GalleryFormRequest $request, $id)
	{
		$this->hasPermission('edit');
		$data['user_id'] = \Auth::user()->id;
		$this->repository->updatePhoto($id, array_merge($request->only('file_name', 'caption', 'album_id'), $data));
	
		return redirect()->back()->with('message', 'Photo updated succssefuly');
	}

	//Delete the gallery
	public function getDelete($id)
	{
		$this->hasPermission('delete');
		$this->repository->deleteGallery($id);
		
		return redirect()->back()->with('message', 'gallery Deleted succssefuly');
	}
}
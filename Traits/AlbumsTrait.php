<?php namespace App\Modules\Gallery\Traits;

use App\Modules\Gallery\Albums;

trait AlbumsTrait{

	public function getAllAlbums()
	{
		return Albums::with('galleries')->paginate('6');
	}

	public function getAlbum($id)
	{
		return Albums::find($id);
	}

	public function createAlbum($data)
	{
		return Albums::create($data);
	}

	public function updateAlbum($id, $data)
	{
		$album = $this->getAlbum($id);
		return $album->update($data);
	}

	public function deleteAlbum($id)
	{	
		$album = $this->getAlbum($id);
		return $album->delete();
	}
}
<?php namespace App\Modules\Gallery\Traits;

use App\Modules\Gallery\Albums;

trait AlbumsTrait{

	public function getAllAlbums()
	{
		return Albums::with('galleries')->paginate('1');
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
		$album->update($data);
		return $album;
	}

	public function deleteAlbum($id)
	{	
		$album = $this->getAlbum($id);
		return $album->delete();
	}
}
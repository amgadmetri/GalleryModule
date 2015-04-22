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

	public function getAlbums($ids = array())
	{
		return Albums::with(['galleries'])->whereIn('id', $ids)->get();
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
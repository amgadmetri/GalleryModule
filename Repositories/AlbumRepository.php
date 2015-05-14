<?php namespace App\Modules\Gallery\Repositories;

use App\AbstractRepositories\AbstractRepository;
use App\Modules\Gallery\Albums;

class AlbumRepository extends AbstractRepository
{
	protected function getModel()
	{
		return 'App\Modules\Gallery\Albums';
	}

	protected function getRelations()
	{
		return ['galleries'];
	}

	public function getAlbums($ids = array())
	{
		return Albums::with($this->getRelations())->whereIn('id', $ids)->get();
	}
}

<?php namespace App\Modules\Gallery\Repositories;

use App\Modules\Core\AbstractRepositories\AbstractRepository;

class AlbumRepository extends AbstractRepository
{	
	/**
	 * Return the model full namespace.
	 * 
	 * @return string
	 */
	protected function getModel()
	{
		return 'App\Modules\Gallery\Albums';
	}

	/**
	 * Return the module relations.
	 * 
	 * @return array
	 */
	protected function getRelations()
	{
		return ['galleries'];
	}

	/**
	 * Return list of albums with the given ids.
	 * 
	 * @param  array  $ids
	 * @return collection
	 */
	public function getAlbums($ids = array())
	{
		return $this->model->with($this->getRelations())->whereIn('id', $ids)->get();
	}
}

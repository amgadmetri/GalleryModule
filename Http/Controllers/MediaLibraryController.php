<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\Controller;

class MediaLibraryController extends Controller {
	/**
	 * Handle the pagination request.
	 * 
	 * @param  string  $type             The gallery type
	 *                                   (photo, video).
	 * @param  boolean $single           Single or multi
	 *                                   select.
	 * @param  string  $medialibraryName
	 * @param  integer $perPage
	 * @return response
	 */
	public function getPaginate($type, $single, $medialibraryName, $perPage)
	{
		return \CMS::galleries()->paginateMediaLibrary($type, $single, $medialibraryName, $perPage);
	}
}
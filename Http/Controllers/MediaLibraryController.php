<?php namespace App\Modules\Gallery\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaLibraryController extends Controller {

	public function getPaginate($type, $single, $medialibraryName, $perPage)
	{
		return \CMS::galleries()->paginateMediaLibrary($type, $single, $medialibraryName, $perPage);
	}
}
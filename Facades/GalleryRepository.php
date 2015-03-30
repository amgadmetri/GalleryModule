<?php namespace App\Modules\Gallery\Facades;

use Illuminate\Support\Facades\Facade;

class GalleryRepository extends Facade
{
	protected static function getFacadeAccessor() { return 'GalleryRepository'; }
}
<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'admin/gallery'], function() {
	
	Route::controllers([
		'medialibrary' => 'MediaLibraryController',
		'album'        => 'AlbumController',
		'thumbnail'    => 'ThumbnailsController',
		'/'            => 'GalleryController'
		]);
});
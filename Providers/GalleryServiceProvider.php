<?php
namespace App\Modules\Gallery\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class GalleryServiceProvider extends ServiceProvider
{
	/**
	 * Register the Gallery module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Gallery\Providers\RouteServiceProvider');

		//Bind GalleryRepository Facade to the IoC Container
		App::bind('GalleryRepository', function()
		{
			return new App\Modules\Gallery\Repositories\GalleryRepository;
		});
		$this->registerNamespaces();
	}

	/**
	 * Register the Gallery module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('gallery', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('gallery', realpath(__DIR__.'/../Resources/Views'));
	}
}

<?php

namespace Msbytes\LaravelWorkdays;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LaravelWorkdaysServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

    public function boot()
    {
        $this->package('msbytes/laravel-workdays');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['workdays'] = $this->app->share(function ($app) {
		    return new Workdays;
        });

		$this->app->booting(function () {
		    $loader = AliasLoader::getInstance();
		    $loader->alias('Workdays', 'Msbytes\LaravelWorkdays\Facades\Workdays');
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}

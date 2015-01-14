<?php namespace AlfredoRamos\ParsedownExtra;

use Illuminate\Support\ServiceProvider;

class ParsedownExtraServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('alfredoramos/parsedownextra');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bindShared('parsedownextra', function() {
			return new \AlfredoRamos\ParsedownExtra\ParsedownExtraOverload;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('parsedownextra');
	}

}

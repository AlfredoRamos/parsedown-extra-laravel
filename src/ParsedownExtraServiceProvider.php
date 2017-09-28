<?php

/**
 * Parsedown Extra package for Laravel
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2015 Alfredo Ramos
 * @license GNU GPL-3.0+
 * @link https://github.com/AlfredoRamos/parsedown-extra-laravel
 */

namespace AlfredoRamos\ParsedownExtra;

use Illuminate\Support\ServiceProvider;

class ParsedownExtraServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->publishes([
			__DIR__ . '/../config/parsedownextra.php' => config_path('parsedownextra.php')
		], 'config');
	}

	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function register() {
		$this->mergeConfigFrom(
			__DIR__ . '/../config/parsedownextra.php', 'parsedownextra'
		);

		$this->app->singleton(ParsedownExtraLaravel::class, function($app) {
			return new ParsedownExtraLaravel;
		});

		$this->app->singleton(HTMLPurifierLaravel::class, function($app) {
			return new HTMLPurifierLaravel;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return [
			ParsedownExtraLaravel::class,
			HTMLPurifierLaravel::class
		];
	}

}

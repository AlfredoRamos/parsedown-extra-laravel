<?php

/**
 * Copyright (C) 2015 Alfredo Ramos
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace AlfredoRamos\ParsedownExtra;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

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

		$this->app->singleton(ParsedownExtraLaravel::class, function($app){
			return new ParsedownExtraLaravel;
		});

		// Register HTML Purifier
		$this->app->register(\Mews\Purifier\PurifierServiceProvider::class);
		AliasLoader::getInstance()->alias('Purifier', \Mews\Purifier\Facades\Purifier::class);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return [ParsedownExtraLaravel::class];
	}

}

<?php namespace AlfredoRamos\ParsedownExtra;
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

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class ParsedownExtraServiceProvider extends ServiceProvider {
	
	public function boot() {
		$this->publishes([
			__DIR__ . '/../config/parsedownextra.php' => config_path('parsedownextra.php')
		]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->mergeConfigFrom(
			__DIR__ . '/../config/parsedownextra.php', 'parsedownextra'
		);
		
		$this->app->singleton('AlfredoRamos\ParsedownExtra\ParsedownExtraOverload', function($app){
			return new ParsedownExtraOverload;
		});
		
		$this->app->register('Mews\Purifier\PurifierServiceProvider');
		
		$loader = AliasLoader::getInstance();
		
		$loader->alias('Purifier', 'Mews\Purifier\Facades\Purifier');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return ['AlfredoRamos\ParsedownExtra\ParsedownExtraOverload'];
	}

}
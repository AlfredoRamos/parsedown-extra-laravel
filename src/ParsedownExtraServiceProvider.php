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

class ParsedownExtraServiceProvider extends ServiceProvider {

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('parsedownextra', function($app){
			return new ParsedownExtraOverload;
		});
		
		$this->app->alias('parsedownextra', 'AlfredoRamos\ParsedownExtra\ParsedownExtraOverload');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['AlfredoRamos\ParsedownExtra\ParsedownExtraOverload'];
	}

}
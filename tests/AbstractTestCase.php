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

namespace AlfredoRamos\Tests;

use Orchestra\Testbench\TestCase;
use AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider;
use AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra as ParsedownExtraFacade;

abstract class AbstractTestCase extends TestCase {

	/**
	 * Setup the test environment.
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->artisan('vendor:publish', [
			'--provider'	=> ParsedownExtraServiceProvider::class,
			'--tag'			=> 'config',
			'--force'		=> true
		]);
	}

	/**
	 * Get package providers.
	 *
	 * @param \Illuminate\Foundation\Application $app
	 *
	 * @return array
	 */
	protected function getPackageProviders($app) {
		return [
			ParsedownExtraServiceProvider::class
		];
	}

	/**
	 * Get package aliases.  In a normal app environment these would be added to
	 * the 'aliases' array in the config/app.php file.
	 *
	 * @param \Illuminate\Foundation\Application $app
	 *
	 * @return array
	 */
	protected function getPackageAliases($app) {
		return [
			'Markdown' => ParsedownExtraFacade::class
		];
	}

}

<?php

/**
 * Parsedown Extra package for Laravel.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2015 Alfredo Ramos
 * @license GPL-3.0-or-later
 * @link https://github.com/AlfredoRamos/parsedown-extra-laravel
 */

namespace AlfredoRamos\Tests;

use AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider;
use AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra as ParsedownExtraFacade;

trait TestCaseTrait {
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
	 * Get package aliases.
	 *
	 * In a normal app environment these would be added to
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

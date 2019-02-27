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

use Orchestra\Testbench\TestCase;
use AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider;

if (version_compare(PHP_VERSION, '7.1.0', '>=')) {
	abstract class AbstractTestCase extends TestCase {
		use TestCaseTrait;

		/**
		 * Setup the test environment.
		 *
		 * @return void
		 */
		protected function setUp(): void {
			parent::setUp();
			$this->artisan('vendor:publish', [
				'--provider'	=> ParsedownExtraServiceProvider::class,
				'--tag'			=> 'config',
				'--force'		=> true
			]);
		}
	}
} else {
	abstract class AbstractTestCase extends TestCase {
		use TestCaseTrait;

		/**
		 * Setup the test environment.
		 *
		 * @return void
		 */
		protected function setUp() {
			parent::setUp();
			$this->artisan('vendor:publish', [
				'--provider'	=> ParsedownExtraServiceProvider::class,
				'--tag'			=> 'config',
				'--force'		=> true
			]);
		}
	}
}

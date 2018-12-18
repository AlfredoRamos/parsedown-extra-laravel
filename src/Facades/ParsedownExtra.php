<?php

/**
 * Parsedown Extra package for Laravel.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2015 Alfredo Ramos
 * @license GPL-3.0-or-later
 * @link https://github.com/AlfredoRamos/parsedown-extra-laravel
 */

namespace AlfredoRamos\ParsedownExtra\Facades;

use Illuminate\Support\Facades\Facade;
use AlfredoRamos\ParsedownExtra\ParsedownExtraLaravel;

class ParsedownExtra extends Facade {
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return ParsedownExtraLaravel::class;
	}
}

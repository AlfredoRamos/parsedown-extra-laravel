<?php

/**
 * Parsedown Extra package for Laravel.
 *
 * @author Alfredo Ramos <alfredo.ramos@protonmail.com>
 * @copyright 2015 Alfredo Ramos
 * @license GPL-3.0-or-later
 * @link https://github.com/AlfredoRamos/parsedown-extra-laravel
 */

namespace AlfredoRamos\Tests\Facades;

use AlfredoRamos\Tests\BaseTestCase;
use AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra as ParsedownExtraFacade;
use Illuminate\Support\Facades\Facade;
use ReflectionClass;

/**
 * @group facades
 */
class ParsedownExtraTest extends BaseTestCase {
	public function testFacade() {
		$class = new ReflectionClass(ParsedownExtraFacade::class);
		$facade = new ReflectionClass(Facade::class);

		$msg = sprintf(
			'%s is not a subclass of %s',
			$class->getName(),
			$facade->getName()
		);

		$this->assertTrue($class->isSubclassOf($facade), $msg);
	}
}

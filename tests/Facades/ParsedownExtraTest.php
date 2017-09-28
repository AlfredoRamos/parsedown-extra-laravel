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

namespace AlfredoRamos\Tests\Facades;

use AlfredoRamos\Tests\AbstractTestCase;
use AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra as ParsedownExtraFacade;
use Illuminate\Support\Facades\Facade;
use ReflectionClass;

/**
 * @group facades
 */
class ParsedownExtraTest extends AbstractTestCase {

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

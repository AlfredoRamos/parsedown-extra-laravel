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

use \Config;

class ParsedownExtraOverload extends \ParsedownExtra {
	
	/**
	 * @deprecated Function overloaded to maintain compatibility.
	 * @see Parsedown::parse()
	 *
	 * @param string $text
	 * @param string|array $config
	 *
	 * @return string
	 */
	function parse($text, $config = 'parsedown') {
		$markdown = parent::text($text);
		
		if (class_exists('Purifier')) {
			if (Config::get('parsedownextra.purifier.enabled')) {
				
				if (is_string($config) && !array_key_exists($config, Config::get('purifier.settings'))) {
					$config = Config::get('parsedownextra.purifier.settings.' . $config);
				}
				
				$markdown = \Purifier::clean(parent::text($text), $config);
			}
		}
		
		return $markdown;
	}
	
}
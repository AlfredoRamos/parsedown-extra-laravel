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
	public function parse($text, $config = null) {
		$markdown = parent::text($text);
		$config = isset($config) ? $config : 'parsedown';
		
		if (class_exists('\\Mews\\Purifier\\Facades\\Purifier')) {
			if (\Config::get('parsedownextra.purifier.enabled')) {
				$markdown = \Purifier::clean(parent::text($text), \Config::get('parsedownextra.purifier.settings.' . $config));
			}
		}
		
		return $markdown;
	}
	
}
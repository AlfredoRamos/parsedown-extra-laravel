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

use ParsedownExtra;
use Purifier;
use Config;

class ParsedownExtraLaravel extends ParsedownExtra {

	/**
	 * Convert Markdown text to HTML and sanitize the output.
	 * @see \Parsedown::parse()
	 *
	 * @param string $text    The Markdown text to convert.
	 * @param array  $options Options for HTML Purifier.
	 *
	 * @return string The resulting HTML from the Markdown text conversion.
	 */
	public function parse($text, $options = []) {
		// Extend default options
		$options = array_merge([
			'config'	=> 'parsedown',
			'purifier'	=> true
		], $options);

		// Parsedown Extra
		$markdown = parent::text($text);

		// HTML Purifier
		if (Config::get('parsedownextra.purifier.enabled') && $options['purifier']) {
			// HTML Purifier configuration
			if (is_string($options['config']) && !empty($options['config'])) {
				$options['config'] = Config::get(sprintf(
					'parsedownextra.purifier.settings.%s',
					$options['config']
				));
			}

			// Filter HTML
			$markdown = Purifier::clean($markdown, $options['config']);
		}

		return $markdown;
	}

}

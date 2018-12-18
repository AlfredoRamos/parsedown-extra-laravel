<?php

/**
 * Parsedown Extra package for Laravel.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2015 Alfredo Ramos
 * @license GPL-3.0-or-later
 * @link https://github.com/AlfredoRamos/parsedown-extra-laravel
 */

namespace AlfredoRamos\ParsedownExtra;

use ParsedownExtra;

class ParsedownExtraLaravel extends ParsedownExtra {
	/**
	 * Convert Markdown text to HTML and sanitize the output.
	 *
	 * @see \Parsedown::parse()
	 *
	 * @param string	$text		The Markdown text to convert.
	 * @param array		$options	Options for HTML Purifier.
	 *
	 * @return string The resulting HTML from the Markdown text conversion.
	 */
	public function parse($text = '', $options = []) {
		// Extend default options
		$options = array_merge([
			'config'	=> [],
			'purifier'	=> true
		], $options);

		// Parsedown Extra
		$markdown = parent::text($text);

		// HTML Purifier
		if (config('parsedownextra.purifier.enabled') && $options['purifier']) {
			$purifier = app(HTMLPurifierLaravel::class);

			// Filter HTML
			$markdown = $purifier->purify($markdown, $options['config']);
		}

		return $markdown;
	}
}

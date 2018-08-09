<?php

/**
 * Parsedown Extra package for Laravel.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2015 Alfredo Ramos
 * @license GPL-3.0-or-later
 * @link https://github.com/AlfredoRamos/parsedown-extra-laravel
 */

use AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra;

if (!function_exists('markdown')) {
	/**
	 * Convert Markdown text to HTML and sanitize the output.
	 *
	 * @see \AlfredoRamos\ParsedownExtra\ParsedownExtraLaravel::parse()
	 *
	 * @param string	$text		The Markdown text to convert.
	 * @param array		$options	Options for HTML Purifier.
	 *
	 * @return string The resulting HTML from the Markdown text conversion.
	 */
	function markdown($text = '', $options = []) {
		return ParsedownExtra::parse($text, $options);
	}
}

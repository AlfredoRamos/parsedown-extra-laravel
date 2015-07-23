<?php namespace AlfredoRamos\ParsedownExtra;
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

class ParsedownExtraOverload extends \ParsedownExtra {
	
	/**
	 * @deprecated Function overloaded to maintain compatibility.
	 * @see Parsedown::parse()
	 *
	 * @param string $text
	 * @param array $options
	 *
	 * @return string
	 */
	public function parse($text, $options = []) {
		/**
		 * Default options
		 */
		$options['config']		= isset($options['config']) ? $options['config'] : 'parsedown';
		$options['purifier']	= isset($options['purifier']) ? $options['purifier'] : true;
		$options['emojis']		= isset($options['emojis']) ? $options['emojis'] : true;
		
		/**
		 * Emoji markdown
		 */
		if (\Config::get('parsedownextra.twemoji.enabled') && $options['emojis']) {
			$twemoji_index = new EmojiIndexOverload;
			$twemoji_index->setConfigFile(public_path('alfredo-ramos/parsedown-extra-laravel') . '/twemoji-index.json');
			
			$twemoji = new EmojiOverload;
			$twemoji->setIndex($twemoji_index);
			$twemoji->setAssetUrlFormat(\Config::get('parsedownextra.twemoji.settings.url_template'));
			
			$text = $twemoji->emojiMarkdown($text);
		}
		
		/**
		 * HTML markup
		 */
		$markdown = parent::text($text);
		
		/**
		 * HTML Purifier
		 */
		if (\Config::get('parsedownextra.purifier.enabled') && $options['purifier']) {
			if (is_string($options['config']) && \Config::has('parsedownextra.purifier.settings.' . $options['config'])) {
				$options['config'] = \Config::get('parsedownextra.purifier.settings.' . $options['config']);
			}
			
			$markdown = \Purifier::clean($markdown, $options['config']);
		}
		
		return $markdown;
	}
	
}
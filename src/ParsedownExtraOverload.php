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
	 * @param string|array $config
	 *
	 * @return string
	 */
	public function parse($text, $config = null) {
		/**
		 * Emoji markdown
		 */
		if (\Config::get('parsedownextra.twemoji.enabled')) {
			$twemoji = new ParsedownExtraEmoji;
			$twemoji->setIndex(new \HeyUpdate\Emoji\EmojiIndex);
			$twemoji->setAssetUrlFormat(\Config::get('parsedownextra.twemoji.settings.url_template'));
			
			$text = $twemoji->emojiMarkdown($text);
		}
		
		/**
		 * HTML markup
		 */
		$markdown = parent::text($text);
		
		/**
		 * Load settings
		 */
		$config = is_null($config) ? 'parsedown' : $config;
		
		/**
		 * HTML Purifier
		 */
		if (\Config::get('parsedownextra.purifier.enabled')) {
			if (is_string($config) && \Config::has('parsedownextra.purifier.settings.' . $config)) {
				/**
				 * HTML Purifier settings
				 */
				$config = \Config::get('parsedownextra.purifier.settings.' . $config);
			}
			
			$markdown = \Purifier::clean($markdown, $config);
		}
		
		return $markdown;
	}
	
}
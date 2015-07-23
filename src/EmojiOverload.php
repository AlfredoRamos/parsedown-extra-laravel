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

class EmojiOverload extends \HeyUpdate\Emoji\Emoji {
	
	/**
	 * Allow create instances without parameters
	 */
	public function __construct() {}
	
	/**
	 * Image markdown syntax
	 * @param string $text
	 *
	 * @return string
	 */
	public function emojiMarkdown($text = '') {
		/**
		 * Laravel config
		 */
		$image = [
			'size'		=> config('parsedownextra.twemoji.settings.svg_image') ? 'svg' : config('parsedownextra.twemoji.settings.image_size') . 'x' . config('parsedownextra.twemoji.settings.image_size'),
			'format'	=> config('parsedownextra.twemoji.settings.svg_image') ? 'svg' : 'png',
			'url'		=> asset($this->assetUrlFormat, config('parsedownextra.twemoji.settings.secure_url'))
		];
		
		/**
		 * Emoji config
		 */
		$index = $this->getIndex();
		$markdownTemplate = '![:%s:](' . $image['url'] . '){.emoji .emoji-%s}';
		
		/**
		 * Replace named emoji
		 */
		$text = preg_replace_callback($index->getEmojiNameRegex(), function ($matches) use ($index, $markdownTemplate, $image) {
			$emoji = $index->findByName($matches[1]);
			return vsprintf($markdownTemplate, [
				$emoji['name'],
				$image['size'],
				$emoji['unicode'],
				$image['format'],
				$emoji['unicode']
			]);
		}, $text);
		
		/**
		 * Replace unicode emoji
		 */
		$text = preg_replace_callback($index->getEmojiUnicodeRegex(), function ($matches) use ($index, $markdownTemplate, $image) {
			$emoji = $index->findByUnicode($matches[0]);
			return vsprintf($markdownTemplate, [
				$emoji['name'],
				$image['size'],
				$emoji['unicode'],
				$image['format'],
				$emoji['unicode']
			]);
		}, $text);
		
		return $text;
	}
	
}
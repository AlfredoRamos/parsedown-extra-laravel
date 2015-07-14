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

class ParsedownExtraEmoji extends \HeyUpdate\Emoji\Emoji {
	
	/**
	 * Allow create instances without parameters
	 */
	public function __construct() {}
	
	/**
	 * Emoji in the image markdown syntax
	 * @param $string
	 *
	 * @return string
	 */
	public function emojiMarkdown($string = '') {
		/**
		 * Laravel config
		 */
		$imageSize = config('parsedownextra.twemoji.settings.svg_image') ? 'svg' : config('parsedownextra.twemoji.settings.image_size') . 'x' . config('parsedownextra.twemoji.settings.image_size');
		$imageFormat = config('parsedownextra.twemoji.settings.svg_image') ? 'svg' : 'png';
		$imageUrl = url($this->assetUrlFormat);
		
		/**
		 * Emoji config
		 */
		$index = $this->getIndex();
		$markdownTemplate = '![:%s:](' . $imageUrl . '){.emoji .emoji-%s}';
		
		/**
		 * Replace named emoji
		 */
		$string = preg_replace_callback($index->getEmojiNameRegex(), function ($matches) use ($index, $markdownTemplate, $imageSize, $imageFormat) {
			$emoji = $index->findByName($matches[1]);
			return vsprintf($markdownTemplate, [
				$emoji['name'],
				$imageSize,
				$emoji['unicode'],
				$imageFormat,
				$emoji['unicode']
			]);
		}, $string);
		
		/**
		 * Replace unicode emoji
		 */
		$string = preg_replace_callback($index->getEmojiUnicodeRegex(), function ($matches) use ($index, $markdownTemplate, $imageSize, $imageFormat) {
			$emoji = $index->findByUnicode($matches[0]);
			return vsprintf($markdownTemplate, [
				$emoji['name'],
				$imageSize,
				$emoji['unicode'],
				$imageFormat,
				$emoji['unicode']
			]);
		}, $string);
		
		return $string;
	}
	
}
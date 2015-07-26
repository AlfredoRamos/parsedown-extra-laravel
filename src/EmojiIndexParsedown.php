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

class EmojiIndexParsedown extends \HeyUpdate\Emoji\EmojiIndex {
	
	/**
	 * Use a custom config file
	 */
	public function __construct() {}
	
	/**
	 * Set the config file and load it
	 */
	public function setConfigFile($configFile) {
		$this->configFile = $configFile;
		
		$this->loadConfig();
	}
	
	/**
	 * Get the current config file
	 */
	public function getConfigFile() {
		return $this->configFile;
	}
	
}
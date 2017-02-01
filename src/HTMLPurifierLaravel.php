<?php

/**
 * Copyright (C) 2017 Alfredo Ramos
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

use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Filesystem\Filesystem;

class HTMLPurifierLaravel {

	protected $filesystem;
	protected $purifier;

	/**
	 * Initialize HTMLPurifier
	 */
	public function __construct() {
		// Configuration
		$config = $this->getConfig();

		// Filesystem
		$this->filesystem = resolve(Filesystem::class);

		// Create cache directory
		if (!$this->filesystem->isDirectory($config->get('Cache.SerializerPath'))) {
			$this->filesystem->makeDirectory(
				$config->get('Cache.SerializerPath'),
				$config->get('Cache.SerializerPermissions')
			);
		}

		// HTMLPurifier
		$this->purifier = new HTMLPurifier($this->getConfig());
	}

	/**
	 * Filter HTML
	 * @see \HTMLPurifier::purify()
	 *
	 * @param	string			$html		The HTML to be cleaned
	 * @param	array|string	$config		HTMLPurifier configuration
	 *
	 * @return	string	Filtered HTML
	 */
	public function purify($html = '', $config = []) {
		return $this->purifier->purify(
			$html,
			$this->getConfig($config)
		);
	}

	/**
	 * Get HTMLPurifier config
	 *
	 * @param	array|string	$data	HTMLPurifier configuration
	 *
	 * @return	HTMLPurifier_Config
	 */
	protected function getConfig($data = []) {
		// HTMLPurifier configuration
		$config = HTMLPurifier_Config::createDefault();
		$config->autofinalize = false;

		// Set default settings, 'default' key must exist
		if (empty($data)) {
			$data = 'default';
		}

		// If string given, get the config array
		if (is_string($data)) {
			$data = config(sprintf(
				'parsedownextra.purifier.settings.%s',
				$data
			));
		}

		// Merge both global and default settings
		$data = array_replace_recursive(
			(array) config('parsedownextra.purifier.settings.global'),
			(array) $data
		);

		// At this point $data should be an array
		if (is_array($data)) {
			$config->loadArray($data);
		}

		return $config;
	}

}

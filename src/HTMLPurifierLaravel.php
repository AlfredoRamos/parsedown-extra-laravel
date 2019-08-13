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

use HTMLPurifier;
use HTMLPurifier_HTML5Config;
use Illuminate\Filesystem\Filesystem;

class HTMLPurifierLaravel {
	/** @var \Illuminate\Filesystem\Filesystem */
	protected $filesystem;

	/** @var \HTMLPurifier */
	protected $purifier;

	/**
	 * Initialize HTMLPurifier.
	 *
	 * @return void
	 */
	public function __construct() {
		// Configuration
		$config = $this->getConfig();

		// Filesystem
		$this->filesystem = app(Filesystem::class);

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
	 * Filter HTML.
	 *
	 * @see \HTMLPurifier::purify()
	 *
	 * @param string		$html	The HTML to be cleaned.
	 * @param array|string	$config	HTMLPurifier configuration.
	 *
	 * @return string Filtered HTML.
	 */
	public function purify($html = '', $config = []) {
		return $this->purifier->purify(
			$html,
			$this->getConfig($config)
		);
	}

	/**
	 * Get HTMLPurifier config.
	 *
	 * @param array|string $data HTMLPurifier configuration.
	 *
	 * @return \HTMLPurifier_Config Configuration object.
	 */
	protected function getConfig($data = []) {
		// HTMLPurifier configuration
		$config = HTMLPurifier_HTML5Config::createDefault();
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

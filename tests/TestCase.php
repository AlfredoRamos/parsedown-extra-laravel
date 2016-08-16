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

namespace AlfredoRamos\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Artisan;
use Markdown;

class TestCase extends BaseTestCase {

	/**
	 * Setup the test environment.
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		Artisan::call('vendor:publish', [
			'--provider'	=> \AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider::class,
			'--tag'			=> 'config',
			'--force'		=> true
		]);
	}

	/**
	 * Get package providers.
	 *
	 * @param  \Illuminate\Foundation\Application  $app
	 *
	 * @return array
	 */
	protected function getPackageProviders($app) {
		return [
			\AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider::class,
			\Mews\Purifier\PurifierServiceProvider::class
		];
	}

	/**
	 * Get package aliases.  In a normal app environment these would be added to
	 * the 'aliases' array in the config/app.php file.
	 *
	 * @param  \Illuminate\Foundation\Application  $app
	 *
	 * @return array
	 */
	protected function getPackageAliases($app) {
		return [
			'Markdown' => \AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra::class
		];
	}

	public function testBasicHtml() {
		$expected = '<p>Parsedown Extra</p>';

		$result = Markdown::parse('Parsedown Extra');

		$this->assertSame($expected, $result);
	}

	public function testBasicFootNote() {
		$expected = '<p>Parsedown Extra <sup id="fnref1:1"><a class="footnote-ref" href="#fn:1">1</a></sup></p>'.PHP_EOL.
			'<div class="footnotes">'.PHP_EOL.
			'<hr />'.
			'<ol>'.
			'<li id="fn:1">'.PHP_EOL.
			'<p>'.
			'<a href="http://parsedown.org/extra/" rel="nofollow noreferrer" target="_blank">http://parsedown.org/extra/</a>'.
			html_entity_decode('&#160;').
			'<a class="footnote-backref" href="#fnref1:1">↩</a>'.
			'</p>'.PHP_EOL.
			'</li>'.PHP_EOL.
			'</ol>'.
			'</div>';

		$result  = Markdown::parse('Parsedown Extra [^1]'.PHP_EOL.'[^1]: http://parsedown.org/extra/');

		$this->assertSame($expected, $result);
	}

	public function testBasicCssClass() {
		$expected = '<h1 class="css_class">Header</h1>';

		$result = Markdown::parse('# Header {.css_class}');

		$this->assertSame($expected, $result);
	}

	public function testCleanLink() {
		$expected = '<p><a>XSS Link</a></p>';

		$result = Markdown::parse('[XSS Link](javascript:alert(\'xss\'))');

		$this->assertSame($expected, $result);
	}

	public function testDisabledExternalLinks() {
		$expected = '<p><a>DuckDuckGo</a></p>';

		$result = Markdown::parse('[DuckDuckGo](https://duckduckgo.com/)', [
			'config' => [
				'URI.Host' => 'localhost',
				'URI.DisableExternal' => true
			]
		]);

		$this->assertSame($expected, $result);
	}

	public function testHtmlPurifierTemporarilyDisabled() {
		$expected = '<p><a href="javascript:alert(\'xss\')">Link</a></p>';

		$result = Markdown::parse('[Link](javascript:alert(\'xss\'))', ['purifier' => false]);

		$this->assertSame($expected, $result);
	}

}

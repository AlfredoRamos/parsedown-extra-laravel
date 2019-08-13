<?php

/**
 * Parsedown Extra package for Laravel.
 *
 * @author Alfredo Ramos <alfredo.ramos@yandex.com>
 * @copyright 2015 Alfredo Ramos
 * @license GPL-3.0-or-later
 * @link https://github.com/AlfredoRamos/parsedown-extra-laravel
 */

namespace AlfredoRamos\Tests;

use Markdown;

/**
 * @group basic
 */
class ParsedownExtraTest extends AbstractTestCase {
	public function testBasicHtml() {
		$expected = '<p>Parsedown Extra</p>';

		$result = Markdown::parse('Parsedown Extra');

		$this->assertSame($expected, $result);
	}

	public function testBasicFootNote() {
		$expected = '<p>Parsedown Extra <sup id="fnref1:1"><a class="footnote-ref" href="#fn:1">1</a></sup></p>'.PHP_EOL.
			'<div class="footnotes">'.PHP_EOL.
			'<hr>'.
			'<ol>'.
			'<li id="fn:1">'.PHP_EOL.
			'<p>'.
			'<a href="http://parsedown.org/extra/" rel="nofollow noreferrer noopener" target="_blank">'.
			'http://parsedown.org/extra/</a>'.
			html_entity_decode('&#160;').
			'<a class="footnote-backref" href="#fnref1:1">↩</a>'.
			'</p>'.PHP_EOL.
			'</li>'.PHP_EOL.
			'</ol>'.
			'</div>';

		$result  = Markdown::parse(
			'Parsedown Extra [^1]'.PHP_EOL.
			'[^1]: http://parsedown.org/extra/'
		);

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
		$expected = '<p><a href="javascript:alert(&#039;xss&#039;)">Link</a></p>';

		$result = Markdown::parse('[Link](javascript:alert(\'xss\'))', ['purifier' => false]);

		$this->assertSame($expected, $result);
	}

	public function testHelperFunction() {
		$expected = '<p><strong>Parsedown Extra</strong> helper function</p>';

		$result = markdown('**Parsedown Extra** helper function');

		$this->assertSame($expected, $result);
	}
}

<?php namespace AlfredoRamos\Tests\Facades;
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

class ParsedownExtraTest extends \Orchestra\Testbench\TestCase {
	
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
			'Markdown' => \AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra::class,
			'Purifier' => \Mews\Purifier\Facades\Purifier::class
		];
	}
	
	public function testBasicHtml() {
		$expected = '<p>Parsedown Extra</p>';
		
		$result = \Markdown::parse('Parsedown Extra');
		
		$this->assertSame($expected, $result);
	}
	
	public function testBasicFootNote() {
		$expected = '<p>Parsedown Extra <sup id="fnref1:1"><a class="footnote-ref" href="#fn:1">1</a></sup></p>'.PHP_EOL.
					'<div class="footnotes">'.PHP_EOL.
						'<hr />'.
						'<ol>'.
							'<li id="fn:1">'.PHP_EOL.
								'<p><a href="http://parsedown.org/extra/" rel="nofollow" target="_blank">http://parsedown.org/extra/</a>' . html_entity_decode('&#160;') . '<a class="footnote-backref" href="#fnref1:1">↩</a></p>'.PHP_EOL.
							'</li>'.PHP_EOL.
						'</ol>'.
					'</div>';
		
		$result  = \Markdown::parse('Parsedown Extra [^1]'.PHP_EOL.'[^1]: http://parsedown.org/extra/');
		
		$this->assertSame($expected, $result);
	}
	
	public function testBasicCssClass() {
		$expected = '<h1 class="css_class">Header</h1>';
		
		$result = \Markdown::parse('# Header {.css_class}');
		
		$this->assertSame($expected, $result);
	}
	
	public function testCleanLink() {
		$expected = '<p><a>XSS Link</a></p>';
		
		$result = \Markdown::parse('[XSS Link](javascript:alert(\'xss\'))');
		
		$this->assertSame($expected, $result);
	}
	
	public function testDisabledExternalLinks() {
		$expected = '<p><a>DuckDuckGo</a></p>';
		
		$result = \Markdown::parse('[DuckDuckGo](https://duckduckgo.com/)', ['config' => ['URI.Host' => 'localhost', 'URI.DisableExternal' => true]]);
		
		$this->assertSame($expected, $result);
	}
	
	public function testEmojiEnabled() {
		$expected = '<p>Have you ever <img alt=":eyes:" class="emoji emoji-1f440" src="https://twemoji.maxcdn.com/svg/1f440.svg" /> the <img alt=":sweat_drops:" class="emoji emoji-1f4a6" src="https://twemoji.maxcdn.com/svg/1f4a6.svg" /> coming <img alt=":point_down:" class="emoji emoji-1f447" src="https://twemoji.maxcdn.com/svg/1f447.svg" /> on a <img alt=":sunny:" class="emoji emoji-2600" src="https://twemoji.maxcdn.com/svg/2600.svg" /> day?</p>';
		
		\Config::set('parsedownextra.twemoji.enabled', true);
		
		$result = \Markdown::parse('Have you ever :eyes: the :sweat_drops: coming :point_down: on a :sunny: day?');
		
		\Config::set('parsedownextra.twemoji.enabled', false);
		
		$this->assertSame($expected, $result);
	}
	
	public function testEmojiDisabled() {
		$expected = '<p>Have you ever :eyes: the :sweat_drops: coming :point_down: on a :sunny: day?</p>';
		
		$result = \Markdown::parse('Have you ever :eyes: the :sweat_drops: coming :point_down: on a :sunny: day?');
		
		$this->assertSame($expected, $result);
	}
	
	public function testHtmlPurifierTemporarilyDisabled() {
		$expected = '<p><a href="javascript:alert(\'xss\')">Link</a></p>';
		
		$result = \Markdown::parse('[Link](javascript:alert(\'xss\'))', ['purifier' => false]);
		
		$this->assertSame($expected, $result);
	}
	
	public function testEmojisTemporarilyDisabled() {
		$expected = '<p>:eyeglasses:</p>';
		
		\Config::set('parsedownextra.twemoji.enabled', true);
		
		$result = \Markdown::parse(':eyeglasses:', ['emojis' => false]);
		
		\Config::set('parsedownextra.twemoji.enabled', false);
		
		$this->assertSame($expected, $result);
	}
}
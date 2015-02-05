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

class ParsedownExtraTest extends Orchestra\Testbench\TestCase {
	
	protected function getPackageProviders() {
		return ['AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider'];
	}
	
	protected function getPackageAliases() {
		return ['Markdown' => 'AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra'];
	}
	
	public function testBasicHtml() {
		$expected = '<p>Parsedown Extra</p>';
		
		$result = Markdown::parse('Parsedown Extra');
		
		$this->assertSame($expected, $result);
	}
	
	public function testBasicAppendix() {
		$expected = '<p>Parsedown Extra <sup id="fnref1:1"><a href="#fn:1" class="footnote-ref">1</a></sup></p>'.PHP_EOL.
					'<div class="footnotes">'.PHP_EOL.
						'<hr />'.PHP_EOL.
						'<ol>'.PHP_EOL.
							'<li id="fn:1">'.PHP_EOL.
								'<p><a href="http://parsedown.org/extra/">http://parsedown.org/extra/</a>&#160;<a href="#fnref1:1" rev="footnote" class="footnote-backref">&#8617;</a></p>'.PHP_EOL.
							'</li>'.PHP_EOL.
						'</ol>'.PHP_EOL.
					'</div>';
		
		$result  = Markdown::parse('Parsedown Extra [^1]'.PHP_EOL.'[^1]: http://parsedown.org/extra/');
		
		$this->assertSame($expected, $result);
	}
	
}
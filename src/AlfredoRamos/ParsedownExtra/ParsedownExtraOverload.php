<?php namespace AlfredoRamos\ParsedownExtra;

class ParsedownExtraOverload extends \ParsedownExtra {
	
	function parse($text) {
		return parent::text($text);
	}
	
}
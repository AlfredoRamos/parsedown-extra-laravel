<?php namespace AlfredoRamos\ParsedownExtra;

use Illuminate\Support\Facades\Facade;

class ParsedownExtraFacade extends Facade {
	
	protected static function getFacadeAccessor() {
		return 'parsedownextra';
	}
	
}
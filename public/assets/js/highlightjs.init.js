/**
 * This file is part of the Parsedown Extra package for Laravel 5
 * @link https://github.com/AlfredoRamos/parsedown-extra-laravel
 */

$(document).on('ready', function() {
	$('pre code').each(function(index, element) {
		hljs.highlightBlock(element);
	});
});
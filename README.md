### About

A [Parsedown Extra](https://github.com/erusev/parsedown-extra) package for Laravel 5

[![Build Status](https://img.shields.io/travis/AlfredoRamos/parsedown-extra-laravel.svg?style=flat-square&maxAge=3600)](https://travis-ci.org/AlfredoRamos/parsedown-extra-laravel) [![Latest Stable Version](https://img.shields.io/packagist/v/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square&label=stable&maxAge=3600)](https://github.com/AlfredoRamos/parsedown-extra-laravel/releases) [![License](https://img.shields.io/packagist/l/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square)](https://raw.githubusercontent.com/AlfredoRamos/parsedown-extra-laravel/master/LICENSE)

### Compatibility table

Version | Laravel | Status
:------:|:-------:|:------:
0.3.x   | 5.1.x   | End of life
0.4.x   | 5.2.x   | End of life
0.5.x   | 5.3.x   | Security fixes only
0.6.x   | 5.4.x   | Active support

### Installation

* Open your `composer.json` file and add the following line in the `require` object:

**Stable version**

```json
"alfredo-ramos/parsedown-extra-laravel": "~0.7.0"
```

**Development version**

```json
"alfredo-ramos/parsedown-extra-laravel": "dev-master"
```

* Run `composer update` on your terminal.

* Service providers and aliases will be registered automatically, thanks to the new package auto-discovery feature of Laravel 5.5.x

### Usage

**sample.blade.php**

```php
{!! Markdown::parse("Hello world") !!}
{!! Markdown::parse("[XSS link](javascript:alert('xss'))") !!}
```

The code above will print:

```html
<p>Hello world</p>

<!-- HTML Purifier enabled -->
<p><a>XSS link</a></p>

<!-- HTML Purifier disabled -->
<p><a href="javascript:alert('xss')">XSS link</a></p>
```

For a live demo, go to [Parsedown Extra Demo](http://parsedown.org/extra/).

### Configuration

[HTML Purifier](https://github.com/ezyang/htmlpurifier) is used to filter the HTML output. You can pass an array or a string that will be the key of the settings array in your configuration file.

To add new or edit the default options, run the following command to make a copy of the configuration file:

```shell
php artisan vendor:publish \
	--provider='AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider' \
	--tag=config --force
```


**Using a string**

```php
Markdown::parse('Hello world!', ['config' => 'comments'])
```

Where `comments` is the key of the array `settings`.

```php
return [
	'purifier'	=> [
		'enabled'	=> true,
		'settings'	=> [
			'default' => [...],
			'comments' => [...]
		]
	]
];
```

**Using an array**

```php
Markdown::parse('[DuckDuckGo](https://duckduckgo.com/)', ['config' => [
	'URI.Host' => 'localhost',
	'URI.DisableExternal' => true
]])
```

For all configuration options see the official [HTML Purifier config docs](http://htmlpurifier.org/live/configdoc/plain.html).

**Using the default settings**

```php
Markdown::parse('Hello world!')
// Is the same as
Markdown::parse('Hello world!', ['config' => 'default'])
```

You can temporarily disable it by setting the option `purifier` to `false`:

```php
Markdown::parse('Text', ['purifier' => false])
```

HTML Purifier can be disabled permanently in the `config/parsedownextra.php` file.

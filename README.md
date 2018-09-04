### About

A [Parsedown Extra](https://github.com/erusev/parsedown-extra) package for Laravel and Lumen

[![Build Status](https://img.shields.io/travis/AlfredoRamos/parsedown-extra-laravel.svg?style=flat-square)](https://travis-ci.org/AlfredoRamos/parsedown-extra-laravel) [![Latest Stable Version](https://img.shields.io/packagist/v/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square&label=stable)](https://packagist.org/packages/alfredo-ramos/parsedown-extra-laravel) [![Code Quality](https://img.shields.io/codacy/grade/8d3f114c909c4c548cc1f60a0b910bcc.svg?style=flat-square)](https://www.codacy.com/app/AlfredoRamos/parsedown-extra-laravel) [![Code Coverage](https://img.shields.io/codacy/coverage/8d3f114c909c4c548cc1f60a0b910bcc.svg?style=flat-square)](https://www.codacy.com/app/AlfredoRamos/parsedown-extra-laravel) [![License](https://img.shields.io/packagist/l/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square)](https://raw.githubusercontent.com/AlfredoRamos/parsedown-extra-laravel/master/LICENSE)

### Compatibility

Version | Laravel  | Lumen    | Status
:------:|:--------:|:--------:|:------------------:
0.6.x   | 5.4.x    | N/A      | End of life
0.7.x   | 5.5.x    | 5.5.x    | Security fixes only
0.8.x   | >= 5.5.x | >= 5.5.x | Active support

### Installation

Open your `composer.json` file and add the package in the `require` object:

```json
"alfredo-ramos/parsedown-extra-laravel": "^0.8.0"
```

Then run `composer update` on your terminal.

#### Laravel

Service providers and aliases will be registered automatically since Laravel `5.5.x`, thanks to the new package auto-discovery.

#### Lumen

In your `bootstrap\app.php` file and register the service provider:

```php
$app->register(AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider::class);
```

Then register the facade alias:

```php
$app->withFacades(true, [
	AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra::class => 'Markdown'
]);
```

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

For your convenience, the `markdown()` helper function is also available. It accepts the same parameters as the facade.

```php
markdown('Hello world', ['purifier' => false])
```

For a live demo, go to [Parsedown Extra Demo](http://parsedown.org/extra/).

### Configuration

[HTML Purifier](https://github.com/ezyang/htmlpurifier) is used to filter the HTML output, protecting your application for insecure content. You can pass an array or a string that will be the key of the settings array in your configuration file.

To add new or edit the default options, run the following command to make a copy of the configuration file:

```shell
php artisan vendor:publish \
	--provider='AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider' \
	--tag=config --force
```


**Using a string**

```php
Markdown::parse('Hello world', ['config' => 'comments'])
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

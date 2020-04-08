### About

A [Parsedown Extra](https://github.com/erusev/parsedown-extra) package for Laravel and Lumen.

[HTML Purifier](https://github.com/ezyang/htmlpurifier) is also used to filter the HTML output, protecting your application for insecure content. Additionally, [HTML5 Definitions for HTML Purifier](https://github.com/xemlock/htmlpurifier-html5) is used to add new definitions and sanitization for HTML5.

[![Build Status](https://img.shields.io/travis/com/AlfredoRamos/parsedown-extra-laravel.svg?style=flat-square)](https://travis-ci.com/AlfredoRamos/parsedown-extra-laravel)
[![Latest Stable Version](https://img.shields.io/packagist/v/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square&label=stable)](https://packagist.org/packages/alfredo-ramos/parsedown-extra-laravel)
[![Code Quality](https://img.shields.io/codefactor/grade/github/AlfredoRamos/parsedown-extra-laravel.svg?style=flat-square)](https://www.codefactor.io/repository/github/alfredoramos/parsedown-extra-laravel)
[![License](https://img.shields.io/packagist/l/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square)](https://raw.githubusercontent.com/AlfredoRamos/parsedown-extra-laravel/master/LICENSE)

### Compatibility

Version | Laravel           | Lumen             | Status
:------:|:-----------------:|:-----------------:|:-------------------:
0.6.x   | 5.4.x             | N/A               | End of life
0.7.x   | 5.5.x             | 5.5.x             | End of life
0.8.x   | >= 5.5.x, < 6.x.x | >= 5.5.x, < 6.x.x | End of life
1.x.x   | 6.x.x             | 6.x.x             | Security fixes only
2.x.x   | 7.x.x             | 7.x.x             | Active support

### Installation

Open your `composer.json` file and add the package in the `require` object:

```json
"alfredo-ramos/parsedown-extra-laravel": "^2.0.0"
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

The `Markdown::parse()` method is responsible to transform the Markdown syntax into HTML, its signature is the following:

```php
Markdown::parse(string $text = '', array $config = [])
```

Parameter | Data type         | Default value | Required | Description
:--------:|:-----------------:|:-------------:|:--------:|:-----------
`$text`   | `string`          | `''`          | Yes      | Markdown text
`$config`  | `array`, `string` | `[]`          | No       | Extra configuration for HTML Purifier

**Notes:**

- If `$config` is a string, it will be trated as an array key in the `[`purifier`][`settings`]` array.
- If `$config` is an array it will extend default configuration for HTML Purifier.
- An empty value for `$config` means that it will use default values for HTML Purifier, see `\AlfredoRamos\ParsedownExtra\HTMLPurifierLaravel::getConfig()` for more information.

**Using `$config` as a string**

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

**Using `$config` as an array**

```php
Markdown::parse('[DuckDuckGo](https://duckduckgo.com/)', ['config' => [
	'URI.Host' => 'localhost',
	'URI.DisableExternal' => true
]])
```

For all configuration options see the official [HTML Purifier config docs](http://htmlpurifier.org/live/configdoc/plain.html).

**Using default settings**

```php
Markdown::parse('Hello world!')
// Is the same as
Markdown::parse('Hello world!', ['config' => 'default'])
```

#### Blade

It can be used in Blade through the `Markdown` facade:

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

#### Helper

For your convenience, the `markdown()` helper function is also available. It accepts the same parameters as the facade.

```php
markdown('Hello world', ['purifier' => false])
```

### Configuration

To add new or edit the default options, run the following command to make a copy of the default configuration file:

```shell
php artisan vendor:publish \
	--provider='AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider' \
	--tag=config --force
```

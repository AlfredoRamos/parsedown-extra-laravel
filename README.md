## Parsedown Extra for Laravel

A [Parsedown Extra](https://github.com/erusev/parsedown-extra) package for Laravel 5.2.x

[![Build Status](https://img.shields.io/travis/AlfredoRamos/parsedown-extra-laravel.svg?style=flat-square&maxAge=3600)](https://travis-ci.org/AlfredoRamos/parsedown-extra-laravel) [![Latest Stable Version](https://img.shields.io/packagist/v/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square&label=stable&maxAge=3600)](https://github.com/AlfredoRamos/parsedown-extra-laravel/releases) [![Latest Unstable Version](https://img.shields.io/packagist/vpre/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square&label=unstable&maxAge=3600)](https://packagist.org/packages/alfredo-ramos/parsedown-extra-laravel) [![License](https://img.shields.io/packagist/l/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square)](https://raw.githubusercontent.com/AlfredoRamos/parsedown-extra-laravel/master/LICENSE)

## Compatibility table

Laravel  | `parsedown-extra-laravel`
:-------:|:------------------------:
5.1.x    | 0.3.x
5.2.x    | 0.4.x
5.3.x    | 0.5.x

## Installation via Composer

* Open your `composer.json` file and add the following line in the `require` object:

**Stable version**

```json
"alfredo-ramos/parsedown-extra-laravel": "~0.5"
```

**Development version**

```json
"alfredo-ramos/parsedown-extra-laravel": "~0.6@dev"
```

* Run `composer install` or `composer update` on your terminal.

* Open your `config/app.php` file and add the following in the `providers` array:

```php
AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider::class
```

* Register the facade in the `aliases` array (`config/app.php` file):

```php
'Markdown'  => AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra::class
```

* And finally deploy all the files needed on your terminal:

```shell
php artisan vendor:publish --provider='AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider' --tag=config --force
```

## Usage

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

## HTML Purifier

The package [mews/purifier](https://packagist.org/packages/mews/purifier) is used to filter the HTML output. By default a `<KEY>` string will be searched in the `config/parsedownextra.php` file to override HTML Purifier default settings, you can also pass an array.

**Using a string**

```php
Markdown::parse('Hello world!', ['config' => 'comments']);
```

Where `comments` is the key of the array `settings` in `config/parsedownextra.php`.

**Using an array**

```php
Markdown::parse('[DuckDuckGo](https://duckduckgo.com/)', ['config' => ['URI.Host' => 'localhost', 'URI.DisableExternal' => true]]);
```

For all configuration options see the official [HTML Purifier config docs](http://htmlpurifier.org/live/configdoc/plain.html).

**Using the default settings**

```php
Markdown::parse('Hello world!');
// Is the same as
Markdown::parse('Hello world!', ['config' => 'parsedown']);
```

You can temporarily disable it by setting the option `purifier` to `false`:

```php
Markdown::parse('Text', ['purifier' => false]);
```

HTML Purifier can be disabled permanently in the `config/parsedownextra.php` file.

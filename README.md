## Parsedown Extra for Laravel
A [Parsedown Extra](https://github.com/erusev/parsedown-extra) package for Laravel 5.

[![Build Status](https://img.shields.io/travis/AlfredoRamos/parsedown-extra-laravel/master.svg?style=flat-square)](https://travis-ci.org/AlfredoRamos/parsedown-extra-laravel) [![Latest Stable Version](https://img.shields.io/github/tag/AlfredoRamos/parsedown-extra-laravel.svg?style=flat-square&label=stable)](https://github.com/AlfredoRamos/parsedown-extra-laravel/releases) [![Latest Unstable Version](https://img.shields.io/packagist/vpre/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square&label=unstable)](https://packagist.org/packages/alfredo-ramos/parsedown-extra-laravel) [![License](https://img.shields.io/packagist/l/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square)](https://packagist.org/packages/alfredo-ramos/parsedown-extra-laravel)

## Installation via Composer
* Open your ```composer.json``` file and add the following line in the ```require``` object:

**Stable version**
```json
"alfredo-ramos/parsedown-extra-laravel": "~0.2"
```

**Development version**
```json
"alfredo-ramos/parsedown-extra-laravel": "~0.3@dev"
```

* Run ```composer install``` or ```composer update``` on your terminal.

* Open your ```config/app.php``` file and add the following in the ```providers``` array:

```php
AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider::class
```

* Register the facade in the ```aliases``` array (```config/app.php``` file):

```php
'Markdown'  => AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra::class
```

* And finally deploy all the files needed on your terminal:

```shell
php artisan vendor:publish --provider='AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider' --force
```

## Usage

**sample.blade.php**
```php
{!! Markdown::parse("Hello world") !!}
{!! Markdown::parse("[XSS link](javascript:alert('xss')") !!}
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
The package [mews/purifier](https://packagist.org/packages/mews/purifier) is used to filter the HTML output. By default a ```<KEY>``` string will be searched in the ```config/parsedownextra.php``` file to override HTML Purifier default settings, you can also pass an array.

**Using a string**
```php
Markdown::parse('Hello world!', ['config' => 'comments']);
```

Where ```comments``` is the key of the array ```settings``` in ```config/parsedownextra.php```.

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

If HTML purifier is enabled, you can temporarily disable it by setting the option ```purifier``` to ```false```:

```php
Markdown::parse('Text', ['purifier' => false]);
```

If you don't want to use HTML Purifier, you can disable it in the ```config/parsedownextra.php``` file.

## Emojis
The [heyupdate/emoji](https://packagist.org/packages/heyupdate/emoji) library is used to add support for [twemoji](https://github.com/twitter/twemoji).

All the emojis have the ```.emoji``` and ```.emoji-<UTF CODE>``` CSS class in case you need to do some changes in your stylesheets to show them properly.

Optionally a default CSS file will be available in your ```public``` directory, to use it, just add the following code anywhere between ```<head>``` and ```</head>```:

**master.blade.php**

```html
@include('parsedownextra::emojis-stylesheet')
```

If emojis are enabled, you can temporarily disable them by setting the option ```emojis``` to ```false```:

```php
Markdown::parse(':eyeglasses:', ['emojis' => false]);
```

Emojis are disabled by default, make sure you've made the changes needed in your stylesheets before enabling them in the ```config/parsedownextra.php``` file.

## Syntax highlighting
The [highlight.js](https://highlightjs.org/) library is used to add support for syntax highlighting.

To use it, just add this feature just add the following code anywhere between ```<head>``` and ```</head>```:

**master.blade.php**

```html
@include('parsedownextra::highlightjs-stylesheet')
```

And the following (preferably) just before ```</body>```:

```html
@include('parsedownextra::highlightjs-script')
```

You can either use any of the bundled initialization scripts (see the example below) or write your own when and where you need it.

```html
<!-- JavaScript (no jQuery needed) -->
@include('parsedownextra::highlightjs-init')

<!-- jQuery >= 1.7 -->
@include('parsedownextra::highlightjs-init-jquery')
```

Syntax highlighting is disabled by default, you can disable it in the ```config/parsedownextra.php``` file.
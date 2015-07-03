## Parsedown Extra for Laravel
A [Parsedown Extra](https://github.com/erusev/parsedown-extra) package for Laravel 5.

[![Build Status](https://img.shields.io/travis/AlfredoRamos/parsedown-extra-laravel/master.svg?style=flat-square)](https://travis-ci.org/AlfredoRamos/parsedown-extra-laravel) [![Latest Stable Version](https://img.shields.io/github/tag/AlfredoRamos/parsedown-extra-laravel.svg?style=flat-square&label=stable)](https://github.com/AlfredoRamos/parsedown-extra-laravel/releases) [![Latest Unstable Version](https://img.shields.io/packagist/vpre/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square&label=unstable)](https://packagist.org/packages/alfredo-ramos/parsedown-extra-laravel) [![License](https://img.shields.io/packagist/l/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square)](https://packagist.org/packages/alfredo-ramos/parsedown-extra-laravel)

## Installation via Composer
* Add the following line to the ```require``` block in your ```composer.json``` file:

**Stable version**
```json
"alfredo-ramos/parsedown-extra-laravel": "~0.2"
```

**Development version**
```json
"alfredo-ramos/parsedown-extra-laravel": "~0.3@dev"
```

Then run ```composer install``` or ```composer update``` in your terminal.

* Open your ```config/app.php``` file and add the following to your ```providers``` array:

```php
AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider::class
```

* Then register the facade to the ```aliases``` array in your ```config/app.php``` file:

```php
'Markdown'  => AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra::class
```

* And finally deploy the config file on your terminal:
```bash
php artisan vendor:publish
```

## Configuration
Stable version uses the [mews/purifier](https://packagist.org/packages/mews/purifier) package. By default it will look for the ```<KEY>``` string in the ```config/parsedownextra.php``` file to override HTML Purifier default settings, but you can also pass an array directly.

**Using a string**
```php
Markdown::parse('Hello world!', 'navbar');
```

Where ```navbar``` is the key of the array, and it exists in ```config/parsedownextra.php@array['settings']```.

**Using an array**
```php
Markdown::parse('Hello world!', ['AutoFormat.RemoveEmpty' => true]);
```

For all configuration options see the official [HTML Purifier config docs](http://htmlpurifier.org/live/configdoc/plain.html).

**Using the default settings**
```php
Markdown::parse('Hello world!');
// Is the same as
Markdown::parse('Hello world!', 'parsedown');
```

If you don't want to use HTML Purifier, you can disable it in the ```config/parsedownextra.php``` file.

## Usage

**sample.blade.php**
```php
{!! Markdown::parse("Hello world") !!}
{!! Markdown::parse("[Malicious link](javascript::alert('xss')") !!}
```

The code above will print:

```html
<p>Hello world</p>

<-- HTML Purifier enabled -->
<p><a>Malicious link</a></p>

<-- HTML Purifier disabled -->
<p><a href="javascript:alert('xss')">Malicious link</a></p>
```

For a live demo, go to [Parsedown Extra Demo](http://parsedown.org/extra/).
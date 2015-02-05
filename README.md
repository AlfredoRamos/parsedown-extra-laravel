Parsedown Extra for Laravel
======================
A [Parsedown Extra](https://github.com/erusev/parsedown-extra) wrapper for Laravel 5.

[![Build Status](https://img.shields.io/travis/AlfredoRamos/parsedown-extra-laravel/master.svg?style=flat-square)](https://travis-ci.org/AlfredoRamos/parsedown-extra-laravel) [![Latest Stable Version](https://img.shields.io/github/tag/AlfredoRamos/parsedown-extra-laravel.svg?style=flat-square)](https://github.com/AlfredoRamos/parsedown-extra-laravel/releases) [![Latest Unstable Version](https://img.shields.io/badge/unstable-0.2--dev-red.svg?style=flat-square)](https://packagist.org/packages/alfredo-ramos/parsedown-extra-laravel) [![License](https://img.shields.io/packagist/l/alfredo-ramos/parsedown-extra-laravel.svg?style=flat-square)](https://packagist.org/packages/alfredo-ramos/parsedown-extra-laravel)

Installation with Composer
====================
* Add the following line to the ```require``` block in your ```composer.json``` file:

```json
"alfredo-ramos/parsedown-extra-laravel": "~0.2"
```

Then run ```composer install``` or ```composer update``` in your terminal.

* Open your ```config/app.php``` file and add the following to your ```providers``` array:

```php
'AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider'
```

* Then register the facade to the ```aliases``` array in your ```config/app.php``` file

```php
'Markdown'  => 'AlfredoRamos\ParsedownExtra\Facades\ParsedownExtra'
```

Usage
=====

**sample.blade.php**
```php
{!! Markdown::parse('Hello world') !!}
```

The code above will print:

```html
<p>Hello world</p>
```

For a live demo, go to [Parsedown Extra Demo](http://parsedown.org/extra/).
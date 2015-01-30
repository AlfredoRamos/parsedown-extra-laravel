Parsedown Extra for Laravel
======================
A [Parsedown Extra](https://github.com/erusev/parsedown-extra) wrapper for Laravel 4

Installation with Composer
====================
* Add the following line to the ```require``` block in your ```composer.json``` file:

```json
"alfredo-ramos/parsedown-extra-laravel": "dev-master"
```

Then run ```composer install``` or ```composer update``` in your terminal.

* Open your ```config/app.php``` file and add the following to your ```providers``` array:

```php
'AlfredoRamos\ParsedownExtra\ParsedownExtraServiceProvider'
```

* Then register the facade to the ```aliases``` array in your ```config/app.php``` file

```php
'Markdown'          => 'AlfredoRamos\ParsedownExtra\ParsedownExtraFacade'
```

Usage
=====

**sample.blade.php**
```php
{{ Markdown::parse('Hello world') }}
```

The code above will print:

```html
<p>Hello world</p>
```

For a live demo, go to [Parsedown Extra Demo](http://parsedown.org/extra/).
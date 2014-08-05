Timpani
=======

Laravel 4 Micro CMS


Installation
============

Update your `composer.json` file to include:

```javascript
"require": {
    "thyyppa\timpani": "~1.0"
}

```

or run

```bash
$ composer require "thyyppa/timpani:~1.0"
$ composer update
```

After installation add the service provider to your `app/config/app.php` file:

```php
'providers' => array(

    ...

    'Thyyppa\Timpani\TimpaniServiceProvider',

),

```

Then publish the assets with artisan:

```bash
$ php artisan asset:publish thyyppa/timpani
```


Useage
======

In your layout files, add `Timpani::stylesheets()` and `Timpani::scripts()` to your `<head>` and at the bottom of the `<body>` tags:

```html+php
<html>
    <head>
        ...
        {{ Timpani::stylesheets() }}
    </head>
    <body>

        ...
        {{ Timpani::scripts() }}
    </body>
</html>

```

If you forget to add the `Timpani::scripts()` call, `Timpani::code(...)` will fall back to a `<textarea>` tag and will not use the [Ace Editor](http://ace.c9.io/).



### Todo
- Add migration information to readme
- Add Timpani::render() to readme
- Add form generation to readme
- Add config options to readme

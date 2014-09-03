Timpani
=======

Laravel 4 Micro CMS


Installation
============

### Update Composer

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

### Add service provider

After installation add the service provider to your `app/config/app.php` file:

```php
'providers' => array(

    ...

    'Thyyppa\Timpani\TimpaniServiceProvider',

),

```

### Publish assets

Then publish the assets with artisan:

**For Laravel 4.2**
```bash
$ php artisan asset:publish thyyppa/timpani
```

**For Laravel 4.3**
```bash
$ php artisan publish:assets thyyppa/timpani
```

### Migrate

... coming soon


### Add scripts and stylesheets to layout

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

### Config

... coming soon

Useage
======

### Display CMS content

To display CMS content from the database use:

```php

{{ Timpani::render('name_of_asset') }}

```

### Display admin form

For a general text input:

```php

{{ Timpani::edit('name_of_asset', 'label', 'text', [ 'html' => 'attributes' ]) }}

```

For a textarea input:

```php

{{ Timpani::edit('name_of_asset', 'label', 'textarea', [ 'html' => 'attributes' ]) }}

```

For an ace editor input:

```php

{{ Timpani::code('name_of_asset', 'label') }}

```

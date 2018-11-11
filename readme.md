This is a Laravel 5 package that provides movies management facility for lavalite framework.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `movies/movies`.

    "movies/movies": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes execute below cammnds in command line to finalize installation.

```php
Movies\Movies\Providers\MoviesServiceProvider::class,

```

And also add it to alias

```php
'Movies'  => Movies\Movies\Facades\Movies::class,
```

Use the below commands for publishing

Migration and seeds

    php artisan vendor:publish --provider="Movies\Movies\Providers\MoviesServiceProvider" --tag="migrations"
    php artisan vendor:publish --provider="Movies\Movies\Providers\MoviesServiceProvider" --tag="seeds"

Configuration

    php artisan vendor:publish --provider="Movies\Movies\Providers\MoviesServiceProvider" --tag="config"

Language

    php artisan vendor:publish --provider="Movies\Movies\Providers\MoviesServiceProvider" --tag="lang"

Views public and admin

    php artisan vendor:publish --provider="Movies\Movies\Providers\MoviesServiceProvider" --tag="view-public"
    php artisan vendor:publish --provider="Movies\Movies\Providers\MoviesServiceProvider" --tag="view-admin"

Publish admin views only if it is necessary.

## Usage



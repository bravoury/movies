<?php

namespace Movies\Movies\Providers;

use Illuminate\Support\ServiceProvider;

class MoviesServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Load view
        $this->loadViewsFrom(__DIR__ . '/../../../../resources/views', 'movies');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/../../../../resources/lang', 'movies');

        // Call pblish redources function
        $this->publishResources();

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Bind facade
        $this->app->bind('movies', function ($app) {
            return $this->app->make('Movies\Movies\Movies');
        });

// Bind Movie to repository
        $this->app->bind(
            \Movies\Movies\Interfaces\MovieRepositoryInterface::class,
            \Movies\Movies\Repositories\Eloquent\MovieRepository::class
        );
        // Bind Genre to repository
        $this->app->bind(
            \Movies\Movies\Interfaces\GenreRepositoryInterface::class,
            \Movies\Movies\Repositories\Eloquent\GenreRepository::class
        );

        $this->app->register(\Movies\Movies\Providers\AuthServiceProvider::class);
        $this->app->register(\Movies\Movies\Providers\EventServiceProvider::class);
        $this->app->register(\Movies\Movies\Providers\RouteServiceProvider::class);
        // $this->app->register(\Movies\Movies\Providers\WorkflowServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['movies'];
    }

    /**
     * Publish resources.
     *
     * @return void
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__ . '/../../../../config/config.php' => config_path('movies/movies.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__ . '/../../../../resources/views' => base_path('resources/views/vendor/movies')], 'view');

        // Publish language files
        $this->publishes([__DIR__ . '/../../../../resources/lang' => base_path('resources/lang/vendor/movies')], 'lang');

        // Publish migrations
        $this->publishes([__DIR__ . '/../../../../database/migrations/' => base_path('database/migrations')], 'migrations');

        // Publish seeds
        $this->publishes([__DIR__ . '/../../../../database/seeds/' => base_path('database/seeds')], 'seeds');

        // Publish public files and assets.
        $this->publishes([__DIR__ . '/public/' => public_path('/')], 'public');
    }
}

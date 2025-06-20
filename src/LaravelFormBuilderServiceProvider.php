<?php

namespace Novius\LaravelFormBuilder;

use Illuminate\Support\ServiceProvider;

class LaravelFormBuilderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-filament-form-builder.php', 'laravel-filament-form-builder');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'laravel-filament-form-builder');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-filament-form-builder');

        $this->publishes([
            __DIR__.'/../lang' => lang_path('vendor/laravel-filament-form-builder'),
        ], 'lang');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/laravel-filament-form-builder.php' => config_path('laravel-filament-form-builder.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-filament-form-builder'),
        ], 'views');
    }
}

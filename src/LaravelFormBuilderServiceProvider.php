<?php

namespace Novius\LaravelFormBuilder;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;
use Novius\LaravelFormBuilder\Http\Middleware\Authorize;
use Laravel\Nova\Http\Middleware\Authenticate;
use Novius\LaravelFormBuilder\Resources\Form;
use Novius\LaravelFormBuilder\Resources\FormResponse;

class LaravelFormBuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-form-builder');

        $this->app->booted(function () {
            $this->routes();

            Nova::resources([
                Form::class,
                FormResponse::class,
            ]);

            Nova::translations(__DIR__.'/../resources/lang/'.app()->getLocale().'.json');
        });

        $packageDir = dirname(__DIR__);

        $this->publishes([__DIR__.'/../config' => config_path()], 'config');

        $this->loadTranslationsFrom($packageDir.'/resources/lang', 'laravel-form-builder');
        $this->publishes([__DIR__.'/../resources/lang' => lang_path('vendor/laravel-form-builder')], 'lang');

        $this->publishes([
            __DIR__.'/../dist/assets' => public_path('vendor/laravel-form-builder'),
        ], 'public');
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Nova::router(['nova', Authenticate::class, Authorize::class], 'laravel-form-builder')
            ->group(__DIR__.'/../routes/inertia.php');

        Route::middleware(['nova', Authorize::class])
            ->prefix('nova-vendor/laravel-form-builder')
            ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel-form-builder.php',
            'laravel-form-builder'
        );
    }
}

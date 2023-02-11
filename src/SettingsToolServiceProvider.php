<?php

namespace RageKings\NovaSettings;

use RageKings\NovaSettings\Commands\SyncCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use RageKings\NovaSettings\Http\Middleware\Authorize;

class SettingsToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                SyncCommand::class
            ]);
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'settings');

        $this->app->booted(function () {
            $this->routes();
        });

        $this->registerPublishing();
        $this->registerResources();
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes(): void
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova', Authorize::class])
                ->prefix('nova-vendor/settings')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Publishing config settings
     *
     * @return void
     */
    protected function registerPublishing(): void
    {
        $this->publishes([
            __DIR__.'/../config/rk-nova-settings.php' => config_path('rk-nova-settings.php'),
        ], 'rk-nova-settings');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/settings'),
        ], 'rk-nova-settings-assets');
    }

    /**
     * Register the package resources such as routes, templates, etc.
     *
     * @return void
     */
    protected function registerResources(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(SettingsService::class, function () {
            return new SettingsService();
        });

        $this->loadHelpers();
    }

    /**
     * Register helpers
     *
     * @return void
     */
    protected function loadHelpers(): void
    {
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}

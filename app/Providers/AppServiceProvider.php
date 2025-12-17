<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerDebugbar();
    }
    
    /**
     * Bootstrap any application services.
    */
    public function boot(): void
    {
        $this->configureVite();
        $this->configureDatabase();
        $this->configureCommands();
    }
    
    /**
     * Configure the application's Vite
     */
    private function configureVite(): void
    {
        Vite::useAggressivePrefetching();
    }

    /**
     * Configure the application's commands
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands($this->app->isProduction());
    }

    /**
    * Configure the application's models
    */
    private function configureDatabase(): void
    {
        Model::shouldBeStrict(! $this->app->isProduction());
        Model::automaticallyEagerLoadRelationships();
    }

    private function registerDebugbar(): void
    {
        if (
            app()->isLocal()
            && app()->hasDebugModeEnabled()
            && class_exists(\Barryvdh\Debugbar\ServiceProvider::class)
            && config('debugbar.enabled')
        ) {
            Log::notice('Registering Debugbar Service Provider');
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}

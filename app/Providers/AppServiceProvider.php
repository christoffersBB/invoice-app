<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(!app()->isProduction());
        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
            if (app()->isProduction()) {
                // In production, log or ignore, but do not throw
            } else {
                throw new \Exception("Attempted to lazy load [{$relation}] on model [".get_class($model)."].");
            }
        });
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
    }
}

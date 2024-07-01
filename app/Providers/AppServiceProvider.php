<?php

namespace App\Providers;

use App\Jobs\DeleteOldTokens;
use Illuminate\Support\ServiceProvider;

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
        DeleteOldTokens::dispatch();
    }
}

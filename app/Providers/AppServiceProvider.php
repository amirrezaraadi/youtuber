<?php

namespace App\Providers;

use App\Jobs\DeleteOldTokens;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }


    public function boot(): void
    {

    }
}

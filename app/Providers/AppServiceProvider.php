<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Load the service provider "JWTAuth"
        $this->app->register(\Tymon\JWTAuth\Providers\LumenServiceProvider::class);
    }
}

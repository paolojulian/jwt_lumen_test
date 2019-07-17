<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Interfaces\UserInterface;

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
        $this->app->singleton(UserInterface::class, UserRepository::class);
    }
}

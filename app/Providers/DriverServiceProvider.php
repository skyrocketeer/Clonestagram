<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DriverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(\App\Http\Contracts\DriverFactory::class, function ($app) {
        //     return new \App\Http\Contracts($app->make('DriverFactory'));
        // });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

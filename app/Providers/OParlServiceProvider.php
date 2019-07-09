<?php

namespace App\Providers;
use App\OParl\OParlApi;
use Illuminate\Support\ServiceProvider;

class OParlServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Contracts\OParlApi::class, function ($app) {
            return new OParlApi(config('oparl.domain'), config('oparl.body_id'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}

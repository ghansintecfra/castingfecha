<?php

namespace CastFecha;

use Illuminate\Support\ServiceProvider;

class CastingFechaProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('parsefecha', function () {
            return new CastingFecha();
        });
    }
}

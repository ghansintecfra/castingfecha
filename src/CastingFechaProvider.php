<?php

namespace Intecfra\CastingFecha;

use Illuminate\Support\ServiceProvider;
use Intecfra\CastingFecha\CastingFecha;

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
        $this->app->bind('fechas', function () {
            return new CastingFecha();
        });
    }
}

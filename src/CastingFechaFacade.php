<?php
/**
 * Created by PhpStorm.
 * User: ghans
 * Date: 12/12/17
 * Time: 10:29 AM
 */

namespace Intecfra\CastingFecha;

use Illuminate\Support\Facades\Facade;


class CastingFechaFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'fechas';
    }
}
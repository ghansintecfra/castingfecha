<?php
namespace CastFecha;

use Carbon\Carbon;

/**
 * Castea las fechas, y funciona como intervalo en fechas en español
 */
class CastingFecha
{
    /**
     *
     * Divide la cadena en parte numerica del formato [0-9]*\s[A-Za-z]* en array
     * regresa la parte indicada por retorno.
     * @param string $cadena
     * @param string $retorno 'A'= Ambos|'N'=>'Numeros'|'C'=>'Cadena'
     * @return array|string $convert|$return
     *
     */

    public function convertirNumero($cadena, $retorno = 'A')
    {
        if (!preg_match('/\d/', $cadena)) {
            $convert = array(0, 'DIAS');
        } else {
            $convert = preg_split('/[\s,]+/', $cadena);
        }
        switch ($retorno) {
            case 'N':
                $return = preg_grep('/[\d]+/', $convert);
                return $return;
                break;
            case 'C':
                $return = preg_grep('/[A-Za-z]+/', $convert);
                return $return;
                break;
            default:
                return $convert;
        }
    }

    /**
     *
     * Convierte a numero la fecha, y agrega el tiempo correspondientes
     * @param string $cadena : Tiempo a agregar
     * @param date $fecha : Fecha a la que se va agregar el tiempo
     * @return date $fechaN
     *
     */

    public function agregarFecha($cadena, $fecha)
    {
        if (preg_match('/\[A-Za-z]*/', $cadena)) {
            $fechaC = $this->convertirNumero($cadena);
        } else {
            $fechaC = array(
                $cadena,
                'DIAS',
            );
        }

        switch ($fechaC[1]) {
            case 'DIAS':case 'dias':case 'Dias':case 'DIA':case 'dia':case 'Dia':
            $fechaN = Carbon::parse($fecha)->addDays($fechaC[0]);
            break;
            case 'MESES':case 'meses':case 'Meses':case 'MES':case 'mes':case 'Mes':
            $fechaN = Carbon::parse($fecha)->addMonths($fechaC);
            break;
            case 'SEMANAS':case 'semanas':case 'Semanas':case 'SEMANA':case 'semana':case 'Semana':
            $fechaN = Carbon::parse($fecha)->addWeeks($fechaC[0]);
            break;
            case 'AÑOS':
                $fechaN = Carbon::parse($fecha)->addYears($fechaC[0]);
                break;
        }

        return $fechaN->format('Y-m-d');
    }

    /**
     *
     * Convierte a numero la fecha, y resta el tiempo correspondientes
     * @param string $cadena : Tiempo a restar
     * @param date $fecha : Fecha a la que se va restar el tiempo
     * @return date $fechaN
     *
     */

    public function restarFecha($cadena, $fecha)
    {
        $fechaC = $this->convertirNumero($cadena);
        switch ($fechaC[1]) {
            case 'DIAS':case 'dias':case 'Dias':case 'DIA':case 'dia':case 'Dia':
            $fechaN = Carbon::parse($fecha)->subDays($fechaC[0]);
            break;
            case 'MESES':case 'meses':case 'Meses':case 'MES':case 'mes':case 'Mes':
            $fechaN = Carbon::parse($fecha)->subMonths($fechaC);
            break;
            case 'SEMANAS':case 'semanas':case 'Semanas':case 'SEMANA':case 'semana':case 'Semana':
            $fechaN = Carbon::parse($fecha)->subWeeks($fechaC[0]);
            break;
            case 'AÑOS':
                $fechaN = Carbon::parse($fecha)->subYears($fechaC[0]);
                break;
        }
        return $fechaN;
    }

    /**
     *
     * Convierte a cadena el tiempo
     * @param int $tiempo
     * @param string $tipo
     * @return string
     *
     */

    public function diasParse($tiempo, $tipo = 'DIAS')
    {
        return $tiempo . ' ' . $tipo;
    }

    /**
     *
     * Regresa la diferencia de dias entre dos fechas
     * @param date fecha1
     * @param date fecha2
     * @return int $dias
     *
     */


    public function diferenciaFechasDias($fecha1, $fecha2)
    {
        $f1   = Carbon::parse($fecha1);
        $f2   = Carbon::parse($fecha2);
        $dias = $f1->diffInDays($f2);
        return $dias;
    }


}

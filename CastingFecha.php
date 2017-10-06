<?php
namespace App\Helpers\castingfecha;

use Carbon\Carbon;
use Debugbar;

/**
 * Castea las fechas, y funciona como intervalo en fechas en español
 */
class CastingFecha
{
    /**
     *
     * Divide la cadena en parte numerica del formato [0-9]*\s[A-Za-z]* en array
     * regresa la parte indicada por retorno.
     * @param $cadena string
     * @param $retorno 'A'= Ambos|'N'=>'Numeros'|'C'=>'Cadena'
     * @return array|string $convert|$return
     *
     */
    
    public function convertirNumero($cadena,$retorno='A')
    {
    	if(!preg_match('/\d/',$cadena))
    	{
    		$convert=array(0,'DIAS');
    	}
    	else
    	{
    		$convert=preg_split('/[\s,]+/',$cadena);	
    	}
    	switch ($retorno) {
    		case 'N':
    			$return=preg_grep('/[\d]+/',$convert);
    			return $return;
    			break;
    		case 'C':
    			$return=preg_grep('/[A-Za-z]+/',$convert);
    			return $return;
    			break;
    		default:
    			return $convert;
    	}
    }

    public function agregarFecha($cadena,$fecha)
    {
    	if(preg_match('/\[A-Za-z]*/',$cadena)){
            $fechaC=$this->convertirNumero($cadena);
        }
        else
        {
            $fechaC=array(
                $cadena,
                'DIAS'
            );
        }
        Debugbar::info($fechaC);
    	switch ($fechaC[1]) {
    		case 'DIAS':case 'dias':case 'Dias':case 'DIA':case 'dia':case 'Dia':
    			$fechaN=Carbon::parse($fecha)->addDays($fechaC[0]);
    			break;
    		case 'MESES':case 'meses':case 'Meses':case 'MES': case 'mes':case 'Mes':
    			$fechaN=Carbon::parse($fecha)->addMonths($fechaC);
    			break;
    		case 'SEMANAS':case 'semanas':case 'Semanas':case 'SEMANA':case 'semana':case 'Semana':
    			$fechaN=Carbon::parse($fecha)->addWeeks($fechaC[0]);
    			break;
    		case 'AÑOS':
    			$fechaN=Carbon::parse($fecha)->addYears($fechaC[0]);
    			break;
    	}
        Debugbar::info($fechaN);
    	return $fechaN->format('Y-m-d');
    }

    public function restarFecha($cadena,$fecha)
    {
    	$fechaC=$this->convertirNumero($cadena);
    	switch ($fechaC[1]) {
    		case 'DIAS':case 'dias':case 'Dias':case 'DIA':case 'dia':case 'Dia':
    			$fechaN=Carbon::parse($fecha)->subDays($fechaC[0]);
    			break;
    		case 'MESES':case 'meses':case 'Meses':case 'MES': case 'mes':case 'Mes':
    			$fechaN=Carbon::parse($fecha)->subMonths($fechaC);
    			break;
    		case 'SEMANAS':case 'semanas':case 'Semanas':case 'SEMANA':case 'semana':case 'Semana':
    			$fechaN=Carbon::parse($fecha)->subWeeks($fechaC[0]);
    			break;
    		case 'AÑOS':
    			$fechaN=Carbon::parse($fecha)->subYears($fechaC[0]);
    			break;
    	}
    	return $fechaN;
    }


}

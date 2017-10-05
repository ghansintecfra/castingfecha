<?php
namespace App\Helpers;
use Carbon\Carbon();

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


}

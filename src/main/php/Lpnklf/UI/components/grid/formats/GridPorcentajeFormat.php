<?php
namespace Cuentas\UI\components\grid\formats;

use Cuentas\UI\utils\CuentasUIUtils;

use Cuentas\Core\model\Sucursal;
use Cuentas\Core\model\Producto;
use Rasty\i18n\Locale;
use Rasty\Grid\entitygrid\model\GridValueFormat;

/**
 * Formato para porcentaje
 *
 * @author Bernardo
 * @since 10-06-2014
 *
 */

class GridPorcentajeFormat extends  GridValueFormat{

	public function __construct(){
	
	}
	
	public function format( $value, $item=null ){
		
		if( $value !=null )
			return  CuentasUIUtils::formatPorcentajeToView($value);
		else $value;	
	}		
	

}
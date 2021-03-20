<?php
namespace Lpnklf\UI\components\grid\formats;

use Lpnklf\UI\utils\LpnklfUIUtils;
use Rasty\Grid\entitygrid\model\GridValueFormat;

use Lpnklf\Core\model\Sucursal;
use Lpnklf\Core\model\Producto;
use Rasty\i18n\Locale;

/**
 * Formato para substring
 *
 * @author Marcos
 * @since 30-07-2019
 *
 */

class GridSubStringFormat extends  GridValueFormat{
	
	
	
	public function __construct($simbolo=null){
		
	}
	
	public function format( $value, $item=null ){
		
		if( $value !=null ){
			if (strlen($value)>200) {
				return  substr($value, 0, 200).'...';
			}
			else return $value;
		}
			
		else $value;	
	}		
	


	
}
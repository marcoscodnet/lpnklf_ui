<?php
namespace Lpnklf\UI\components\grid\formats;

use Lpnklf\UI\utils\LpnklfUIUtils;
use Rasty\Grid\entitygrid\model\GridValueFormat;


use Rasty\i18n\Locale;

/**
 * Formato para boolean
 *
 * @author Bernardo
 * @since 01-12-2014
 *
 */

class GridBooleanFormat extends  GridValueFormat{

	public function __construct(){
	
	}
	
	public function format( $value, $item=null ){
		
		if( $value )
			return  "SI";
		else $value;	
	}		
	

}
<?php
namespace Lpnklf\UI\components\grid\formats;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\Core\model\Prioridad;
use Rasty\Grid\entitygrid\model\GridValueFormat;
use Rasty\i18n\Locale;

/**
 * Formato para renderizar el estado de una tarea
 *
 * @author Marcos
 * @since 08-03-2018
 *
 */

class GridPrioridadFormat extends  GridValueFormat{

	private $pattern;
	
	public function format( $value, $item=null ){
		
		if( !empty($value))
			return  Locale::localize( Prioridad::getLabel( $value ) );
		else $value;	
	}		
	
	
	
	public function getPattern(){
		return $this->pattern;
	}
	
}
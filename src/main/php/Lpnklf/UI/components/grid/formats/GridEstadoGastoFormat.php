<?php
namespace Lpnklf\UI\components\grid\formats;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\Core\model\EstadoGasto;
use Rasty\Grid\entitygrid\model\GridValueFormat;
use Rasty\i18n\Locale;

/**
 * Formato para renderizar el estado de un gasto
 *
 * @author Marcos
 * @since 12-03-2018
 *
 */

class GridEstadoGastoFormat extends  GridValueFormat{

	private $pattern;
	
	public function format( $value, $item=null ){
		
		if( !empty($value))
			return  Locale::localize( EstadoGasto::getLabel( $value ) );
		else $value;	
	}		
	
	public function getColumnCssClass($value, $item=null){
	
		return LpnklfUIUtils::getEstadoGastoCss($value);
	}
	
	public function getPattern(){
		return $this->pattern;
	}
	
}
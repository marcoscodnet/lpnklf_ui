<?php

namespace Lpnklf\UI\components\filter\movimiento;


use Lpnklf\UI\service\UIServiceFactory;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\components\grid\model\MovimientoServicioTecnicoGridModel;

use Lpnklf\UI\components\filter\model\UIMovimientoServicioTecnicoCriteria;


use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar movimientos de ServicioTecnico
 * 
 * @author Marcos
 * @since 07-04-2018
 */
class MovimientoServicioTecnicoFilter extends Filter{
		
	
	
	public function getType(){
		
		return "MovimientoServicioTecnicoFilter";
	}
	
	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new MovimientoServicioTecnicoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIMovimientoServicioTecnicoCriteria()) );
		
		
		$this->addProperty("fechaDesde");
		$this->addProperty("fechaHasta");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el banco con bapro
		//$this->fillInput("cuenta", UIServiceFactory::getUIBancoService()->getCajaBAPRO() );
		
		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_fechaDesde",  $this->localize( "criteria.fechaDesde" ) );
		$xtpl->assign("lbl_fechaHasta",  $this->localize( "criteria.fechaHasta" ) );
		
		
	}
	
	
	
}
?>
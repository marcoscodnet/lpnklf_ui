<?php

namespace Lpnklf\UI\components\filter\servicioTecnico;

use Lpnklf\UI\components\filter\model\UIServicioTecnicoCriteria;

use Lpnklf\UI\components\filter\model\UIEstadoCriteria;

use Lpnklf\UI\components\grid\model\ServicioTecnicoGridModel;

use Lpnklf\UI\service\finder\EstadoFinder;

use Lpnklf\UI\service\UIServiceFactory;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar serviciosTecnico
 * 
 * @author Marcos
 * @since 08/03/2018
 */
class ServicioTecnicoFilter extends Filter{
		
	public function getType(){
		
		return "ServicioTecnicoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new ServicioTecnicoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIServicioTecnicoCriteria()) );
		
		//$this->setSelectRowCallback("seleccionarServicioTecnico");
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("fechaDesde");
		$this->addProperty("fechaHasta");
		$this->addProperty("cliente");
		
		$this->addProperty("filtroPredefinido");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_fechaDesde",  $this->localize("criteria.fechaDesde") );
		$xtpl->assign("lbl_fechaHasta",  $this->localize("criteria.fechaHasta") );
		$xtpl->assign("lbl_cliente", $this->localize("servicioTecnico.cliente") );
		$xtpl->assign("lbl_predefinidos",  $this->localize("criteria.predefinidos") );
				
		
		
		//$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "HistoriaClinica") );
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "ServicioTecnicoModificar") );
		
		
	}
	
	public function getFiltrosPredefinidos(){
		
		$items = array();
		
		$items[ UIServicioTecnicoCriteria::HOY ] = $this->localize("servicioTecnico.filter.hoy");
		$items[ UIServicioTecnicoCriteria::SEMANA_ACTUAL ] = $this->localize("servicioTecnico.filter.semanaActual");
		$items[ UIServicioTecnicoCriteria::MES_ACTUAL ] = $this->localize("servicioTecnico.filter.mesActual");
		$items[ UIServicioTecnicoCriteria::ANIO_ACTUAL ] = $this->localize("servicioTecnico.filter.anioActual");
		$items[ UIServicioTecnicoCriteria::IMPAGAS ] = $this->localize("servicioTecnico.filter.impagas");
		$items[ UIServicioTecnicoCriteria::ANULADAS ] = $this->localize("servicioTecnico.filter.anuladas");
		
		return $items;
		
	}
	
}
?>
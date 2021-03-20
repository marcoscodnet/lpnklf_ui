<?php

namespace Lpnklf\UI\components\filter\estado;

use Lpnklf\UI\components\filter\model\UIEstadoCriteria;

use Lpnklf\UI\components\grid\model\EstadoGridModel;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;

/**
 * Filtro para buscar estados
 * 
 * @author Marcos
 * @since 05/03/2018
 */
class EstadoFilter extends Filter{
		
	public function getType(){
		
		return "EstadoFilter";
	}
	

	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new EstadoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIEstadoCriteria()) );
		
		//$this->setSelectRowCallback("seleccionarEstado");
		
		//agregamos las propiedades a popular en el submit.
		$this->addProperty("nombre");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el nombre con el texto inicial
		$this->fillInput("nombre", $this->getInitialText() );
		
		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("lbl_nombre",  $this->localize("estado.nombre") );
		
		//$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "HistoriaClinica") );
		$xtpl->assign("linkSeleccionar",  LinkBuilder::getPageUrl( "EstadoModificar") );
		
		
	}
}
?>
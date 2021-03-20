<?php

namespace Lpnklf\UI\components\filter\historicoEstado;


use Lpnklf\UI\service\UIServiceFactory;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\components\grid\model\HistoricoEstadoGridModel;

use Lpnklf\UI\components\filter\model\UIHistoricoEstadoCriteria;

use Lpnklf\UI\components\filter\model\UIEstadoCriteria;

use Lpnklf\UI\service\finder\EstadoFinder;

use Rasty\Grid\filter\Filter;
use Rasty\utils\XTemplate;
use Rasty\utils\LinkBuilder;
use Rasty\utils\RastyUtils;

/**
 * Filtro para buscar historicoEstados
 * 
 * @author Marcos
 * @since 04-04-2018
 */
class HistoricoEstadoFilter extends Filter{
		
	private $servicioTecnico;
	
	public function getType(){
		
		return "HistoricoEstadoFilter";
	}
	
	public function __construct(){
		
		parent::__construct();
		
		$this->setGridModelClazz( get_class( new HistoricoEstadoGridModel() ));
		
		$this->setUicriteriaClazz( get_class( new UIHistoricoEstadoCriteria()) );
		
		
		$this->addProperty("fechaDesde");
		$this->addProperty("fechaHasta");
		$this->addProperty("estado");
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		//rellenamos el banco con bapro
		//$this->fillInput("cuenta", UIServiceFactory::getUIBancoService()->getCajaBAPRO() );
		
		parent::parseXTemplate($xtpl);

		$xtpl->assign("lbl_fechaDesde",  $this->localize( "criteria.fechaDesde" ) );
		$xtpl->assign("lbl_fechaHasta",  $this->localize( "criteria.fechaHasta" ) );
		$xtpl->assign("lbl_estado", $this->localize("servicioTecnico.estadoServicio") );
		
		$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get( RastyUtils::getParamGET("servicioTecnicoOid") );
		
		if( !empty( $servicioTecnico)  ){
			$xtpl->assign("lbl_servicioTecnico",  $servicioTecnico->__toString() );
			$xtpl->assign("servicioTecnicoOid",  $servicioTecnico->getOid() );
			
		}
		
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get( RastyUtils::getParamPOST("servicioTecnicoOid") );
		
		$entity->setServicioTecnico( $servicioTecnico );		
		
	}
	
	public function getEstadoFinderClazz(){
		
		return get_class( new EstadoFinder() );
		
	}	
	
	public function getEstados(){
		
		$estados = UIServiceFactory::getUIEstadoService()->getList( new UIEstadoCriteria() );
		
		return $estados;
	}
	

	public function getServicioTecnico()
	{
	    return $this->servicioTecnico;
	}

	public function setServicioTecnico($servicioTecnico)
	{
	    $this->servicioTecnico = $servicioTecnico;
	}
	
	public function getHistoricoEstado()
	{
	    
	}
}
?>
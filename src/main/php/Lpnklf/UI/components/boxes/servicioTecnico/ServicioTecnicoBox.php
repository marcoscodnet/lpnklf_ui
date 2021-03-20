<?php

namespace Lpnklf\UI\components\boxes\servicioTecnico;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Lpnklf\Core\model\ServicioTecnico;
use Lpnklf\Core\model\EstadoVenta;
use Lpnklf\Core\model\Prioridad;

use Rasty\utils\LinkBuilder;

/**
 * servicioTecnico.
 * 
 * @author Marcos
 * @since 05-04-2018
 */
class ServicioTecnicoBox extends RastyComponent{
		
	private $servicioTecnico;
	
	public function getType(){
		
		return "ServicioTecnicoBox";
		
	}

	public function __construct(){
		
		
	}

	protected function parseLabels(XTemplate $xtpl){
		
		$xtpl->assign("lbl_fecha",  $this->localize( "servicioTecnico.fecha" ) );
		
		$xtpl->assign("lbl_servicioTecnico",  $this->localize( "servicioTecnico.servicioTecnico" ) );
		$xtpl->assign("lbl_estadoServicio",  $this->localize( "servicioTecnico.estadoServicio" ) );
		$xtpl->assign("lbl_prioridad",  $this->localize( "servicioTecnico.prioridad" ) );
		$xtpl->assign("lbl_diagnostico",  $this->localize( "servicioTecnico.diagnostico" ) );
		$xtpl->assign("lbl_solucion",  $this->localize( "servicioTecnico.solucion" ) );
		$xtpl->assign("lbl_observaciones",  $this->localize( "servicioTecnico.observaciones" ) );
		$xtpl->assign("lbl_monto",  $this->localize( "servicioTecnico.monto" ) );
		$xtpl->assign("lbl_montoPagado",  $this->localize( "servicioTecnico.montoPagado" ) );
		$xtpl->assign("lbl_montoDebe",  $this->localize( "servicioTecnico.montoDebe" ) );
		$xtpl->assign("lbl_estado",  $this->localize( "servicioTecnico.estado" ) );
		
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		
		/*labels*/
		$this->parseLabels($xtpl);
		
		$servicioTecnico = $this->getServicioTecnico();
		
			
		
		$xtpl->assign( "servicioTecnico", $this->getServicioTecnico() );
		
		$xtpl->assign( "monto", LpnklfUIUtils::formatMontoToView( $this->getServicioTecnico()->getMonto() ) );
		$xtpl->assign( "montoPagado", LpnklfUIUtils::formatMontoToView( $this->getServicioTecnico()->getMontoPagado() ) );
		$xtpl->assign( "montoDebe", LpnklfUIUtils::formatMontoToView( $this->getServicioTecnico()->getMontoDebe() ) );
		$xtpl->assign( "montoTotal", $this->getServicioTecnico()->getMontoDebe() );
		
		$xtpl->assign( "estadoServicio", $this->getServicioTecnico()->getEstadoServicio() );
		$xtpl->assign( "prioridad", $this->localize(Prioridad::getLabel($this->getServicioTecnico()->getPrioridad() )));
		$xtpl->assign( "diagnostico", $this->getServicioTecnico()->getDiagnostico() );
		$xtpl->assign( "solucion", $this->getServicioTecnico()->getSolucion() );
		$xtpl->assign( "observaciones", $this->getServicioTecnico()->getObservaciones() );
		$xtpl->assign( "fecha", LpnklfUIUtils::formatDateTimeToView($this->getServicioTecnico()->getFecha()) );
		$xtpl->assign( "estado", $this->localize( EstadoVenta::getLabel( $servicioTecnico->getEstado()) ) );
		
		
			
	}
	
	
	protected function initObserverEventType(){
		$this->addEventType( "ServicioTecnico" );
	}
	
	public function setServicioTecnicoOid($oid){
		if( !empty($oid) ){
			$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get($oid);
			$this->setServicioTecnico($servicioTecnico);
		}
	}   
    

	public function getServicioTecnico()
	{
	    return $this->servicioTecnico;
	}

	public function setServicioTecnico($servicioTecnico)
	{
	    $this->servicioTecnico = $servicioTecnico;
	}
}
?>
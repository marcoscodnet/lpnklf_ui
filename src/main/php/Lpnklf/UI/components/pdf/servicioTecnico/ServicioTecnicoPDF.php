<?php

namespace Lpnklf\UI\components\pdf\servicioTecnico;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Lpnklf\Core\model\ServicioTecnico;

use Rasty\utils\LinkBuilder;
use Rasty\render\DOMPDFRenderer;
use Rasty\conf\RastyConfig;

/**
 * para renderizar en pdf la plantilla de contrato
 * de un servicioTecnico.
 * 
 * @author Marcos
 * @since 30-01-2019
 * 
 */
class ServicioTecnicoPDF extends RastyComponent{
		
	private $servicioTecnico;
	
	public function getType(){
		
		return "ServicioTecnicoPDF";
		
	}

	public function __construct(){
		
		
	}

	
	protected function parseXTemplate(XTemplate $xtpl){
		
		
		$xtpl->assign( "APP_PATH", RastyConfig::getInstance()->getAppPath() );
		$servicioTecnico = $this->getServicioTecnico();
		
		if( !empty($servicioTecnico )){
			
			/*$contrato = html_entity_decode( $servicioTecnico->getDetalleFalla() );
			
			$xtpl->assign("contrato",  $contrato );*/
			$xtpl->assign( "oid", $servicioTecnico->getOid() );
			$xtpl->assign( "fecha", LpnklfUIUtils::formatDateTimeToView($servicioTecnico->getFecha()) );
			$xtpl->assign( "cliente", $servicioTecnico->getCliente() );
			$xtpl->assign( "celular", $servicioTecnico->getCliente()->getCelular() );
			$xtpl->assign( "telefono", $servicioTecnico->getCliente()->getTelefono() );
			$xtpl->assign( "email", $servicioTecnico->getCliente()->getMail() );
			
			$xtpl->assign( "tipo", $servicioTecnico->getTipoProducto() );
			$xtpl->assign( "marca", $servicioTecnico->getMarcaProducto() );
			$xtpl->assign( "modelo", $servicioTecnico->getModelo() );
			$xtpl->assign( "fuente", $servicioTecnico->getFuente() );
			$xtpl->assign( "bateria", $servicioTecnico->getBateria() );
			$xtpl->assign( "clave", $servicioTecnico->getClave() );
			
			$xtpl->assign( "notas", $servicioTecnico->getObservaciones() );
			$xtpl->assign( "detalleFalla", $servicioTecnico->getDetalleFalla() );
			
			$xtpl->assign( "diasDemora", $servicioTecnico->getDiasDemora() );
			$xtpl->assign( "reparaHasta", LpnklfUIUtils::formatMontoToView( $servicioTecnico->getReparaHasta() ) );
			
			/*$xtpl->assign( "monto", LpnklfUIUtils::formatMontoToView( $servicioTecnico->getMonto() ) );
			$xtpl->assign( "montoPagado", LpnklfUIUtils::formatMontoToView( $servicioTecnico->getMontoPagado() ) );
			$xtpl->assign( "montoDebe", LpnklfUIUtils::formatMontoToView( $servicioTecnico->getMontoDebe() ) );
			$xtpl->assign( "montoTotal", $servicioTecnico->getMontoDebe() );
			
			$xtpl->assign( "estadoServicio", $servicioTecnico->getEstadoServicio() );
			
			$xtpl->assign( "diagnostico", $servicioTecnico->getDiagnostico() );
			$xtpl->assign( "solucion", $servicioTecnico->getSolucion() );
			$xtpl->assign( "observaciones", $servicioTecnico->getObservaciones() );*/
			
			
		
		
				
		}else{
			$xtpl->assign("contrato",  "no existe la plantilla" );
		}
						
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
	
	public function getPDFRenderer(){
		
		$renderer = new DOMPDFRenderer();
		return $renderer;
	}
}
?>
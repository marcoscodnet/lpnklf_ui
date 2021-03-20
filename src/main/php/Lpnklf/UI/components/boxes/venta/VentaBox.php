<?php

namespace Lpnklf\UI\components\boxes\venta;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\service\UIServiceFactory;

use Rasty\components\RastyComponent;
use Rasty\utils\RastyUtils;

use Rasty\utils\XTemplate;

use Lpnklf\Core\model\Venta;
use Lpnklf\Core\model\EstadoVenta;

use Rasty\utils\LinkBuilder;

/**
 * venta.
 * 
 * @author Marcos
 * @since 12-03-2018
 */
class VentaBox extends RastyComponent{
		
	private $venta;
	
	public function getType(){
		
		return "VentaBox";
		
	}

	public function __construct(){
		
		
	}

	protected function parseLabels(XTemplate $xtpl){
		
		$xtpl->assign("lbl_fecha",  $this->localize( "venta.fecha" ) );
		
		$xtpl->assign("lbl_cliente",  $this->localize( "venta.cliente" ) );
		$xtpl->assign("lbl_observaciones",  $this->localize( "venta.observaciones" ) );
		$xtpl->assign("lbl_monto",  $this->localize( "venta.monto" ) );
		$xtpl->assign("lbl_montoPagado",  $this->localize( "venta.montoPagado" ) );
		$xtpl->assign("lbl_montoDebe",  $this->localize( "venta.montoDebe" ) );
		$xtpl->assign("lbl_estado",  $this->localize( "venta.estado" ) );
		
		$xtpl->assign("lbl_detalle_nombre", $this->localize( "venta.detalle.producto" ) );
		$xtpl->assign("lbl_detalle_precio", $this->localize( "venta.detalle.precio" ) );
		$xtpl->assign("lbl_detalle_cantidad", $this->localize( "venta.detalle.cantidad" ) );
		$xtpl->assign("lbl_detalle_subtotal", $this->localize( "venta.detalle.subtotal" ) );
		
		$xtpl->assign("lbl_totales",  $this->localize( "venta.detalles.totales" ) );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		
		/*labels*/
		$this->parseLabels($xtpl);
		
		$venta = $this->getVenta();
		
			
		
		$xtpl->assign( "cliente", $this->getVenta()->getCliente() );
		
		$xtpl->assign( "monto", LpnklfUIUtils::formatMontoToView( $this->getVenta()->getMonto() ) );
		$xtpl->assign( "montoPagado", LpnklfUIUtils::formatMontoToView( $this->getVenta()->getMontoPagado() ) );
		$xtpl->assign( "montoDebe", LpnklfUIUtils::formatMontoToView( $this->getVenta()->getMontoDebe() ) );
		$xtpl->assign( "montoTotal", $this->getVenta()->getMontoDebe() );
		
		$xtpl->assign( "observaciones", $this->getVenta()->getObservaciones() );
		$xtpl->assign( "fecha", LpnklfUIUtils::formatDateTimeToView($this->getVenta()->getFecha()) );
		$xtpl->assign( "estado", $this->localize( EstadoVenta::getLabel( $venta->getEstado()) ) );
		
		$cantidadTotal = 0;
		foreach ($venta->getDetalles() as $detalle) {
			$xtpl->assign( "producto", $detalle->getProducto() );
			$xtpl->assign( "cantidad", $detalle->getCantidad() );
			$xtpl->assign( "precio", LpnklfUIUtils::formatMontoToView( $detalle->getPrecioUnitario() ) );
			$xtpl->assign( "subtotal", LpnklfUIUtils::formatMontoToView( $detalle->getSubtotal() ) );
			$xtpl->parse( "main.detalle" );
			
			$cantidadTotal += $detalle->getCantidad();
		}
		
		$xtpl->assign( "total", LpnklfUIUtils::formatMontoToView( $venta->getMonto() ) );
		$xtpl->assign( "cantidad_total", $cantidadTotal );
			
	}
	
	
	protected function initObserverEventType(){
		$this->addEventType( "Venta" );
	}
	
	public function setVentaOid($oid){
		if( !empty($oid) ){
			$venta = UIServiceFactory::getUIVentaService()->get($oid);
			$this->setVenta($venta);
		}
	}   
    

	public function getVenta()
	{
	    return $this->venta;
	}

	public function setVenta($venta)
	{
	    $this->venta = $venta;
	}
}
?>
<?php

namespace Lpnklf\UI\components\form\venta;

use Lpnklf\UI\service\finder\ClienteFinder;



use Lpnklf\UI\service\finder\ProductoFinder;


use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\service\UIServiceFactory;

use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;


use Lpnklf\Core\model\Venta;
use Lpnklf\Core\model\DetalleVenta;


use Rasty\utils\LinkBuilder;
use Rasty\security\RastySecurityContext;

/**
 * Formulario para venta

 * @author Marcos
 * @since 09/03/2018
 */
class VentaForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Venta
	 */
	private $venta;
	
	private $detalle;
	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("venta.cancelar");
		$this->setLabelSubmit("venta.confirmar");
		
		$this->addProperty("fecha");
		
		$this->addProperty("cliente");
		$this->addProperty("observaciones");
		
		$this->setBackToOnSuccess("VentaCobrar");
		$this->setBackToOnCancel("Ventas");
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "VentaForm";
		
	}
	
	public function fillEntity($entity){
		
		//le agregamos los detalles de sesión.
		$detalles = LpnklfUIUtils::getDetallesVentaSession();
		
		
		parent::fillEntity($entity);
		
		
		foreach ($detalles as $detallejson) {
			$detalle = new DetalleVenta();
			
			$detalle->setCantidad( $detallejson["cantidad"] );
			$detalle->setPrecioUnitario( $detallejson["precioUnitario"] );
			$detalle->setProducto( UIServiceFactory::getUIProductoService()->get($detallejson["producto_oid"]) );
			
			$entity->addDetalle( $detalle );
			
		}
		
		$user = RastySecurityContext::getUser();
		$user = \Cose\Security\service\ServiceFactory::getUserService()->getUserByUsername($user->getUsername());
		$entity->setUser( $user );
		
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_fecha", $this->localize("venta.fecha") );
		
		$xtpl->assign("lbl_cliente", $this->localize("venta.cliente") );
		$xtpl->assign("lbl_observaciones", $this->localize("venta.observaciones") );
		
		$xtpl->assign("detalles_legend", $this->localize("venta.agregar.detalles_legend") );
		$xtpl->assign("lbl_detalle_nombre", $this->localize( "venta.detalle.producto" ) );
		$xtpl->assign("lbl_detalle_precio", $this->localize( "venta.detalle.precio" ) );
		$xtpl->assign("lbl_detalle_cantidad", $this->localize( "venta.detalle.cantidad" ) );
		$xtpl->assign("lbl_detalle_subtotal", $this->localize( "venta.detalle.subtotal" ) );
		
		
		
		$xtpl->assign("linkAgregarDetalle", $this->getLinkActionAgregarDetalle() );
		$xtpl->assign("linkBorrarDetalle", $this->getLinkActionBorrarDetalle() );
		
		
	
		
		
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}

	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}
	
	
	
	public function getProductoFinderClazz(){
		
		return get_class( new ProductoFinder() );
		
	}	
	
	public function getVenta()
	{
	    return $this->venta;
	}

	public function setVenta($venta)
	{
	    $this->venta = $venta;
	}

	public function getDetalle()
	{
	    return $this->detalle;
	}

	public function setDetalle($detalle)
	{
	    $this->detalle = $detalle;
	}
	

	public function getLinkActionAgregarDetalle(){
		
		return LinkBuilder::getActionAjaxUrl( "AgregarDetalleVentaJson") ;
		
	}
	
	public function getLinkActionBorrarDetalle(){
		
		return LinkBuilder::getActionAjaxUrl( "BorrarDetalleVentaJson") ;
		
	}
	
	
	
	public function getClienteFinderClazz(){
		
		return get_class( new ClienteFinder() );
		
	}	
	
}
?>
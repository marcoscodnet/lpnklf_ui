<?php
namespace Lpnklf\UI\pages;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\Core\model\Cuenta;
use Lpnklf\Core\model\Gasto;
use Lpnklf\Core\model\Venta;
use Lpnklf\Core\model\ServicioTecnico;
use Rasty\components\RastyPage;
use Rasty\utils\LinkBuilder;

/**
 * página genérica para la app de cuentas
 * 
 * @author Marcos
 * @since 01/03/2018
 */
abstract class LpnklfPage extends RastyPage{


	
	public function getTitle(){
		return $this->localize( "cuentas_app.title" );
	}

	public function getMenuGroups(){

		return array();
	}

	public function getLinkLpnklf(){
		
		return LinkBuilder::getPageUrl( "Lpnklf") ;
		
	}
	
	
	
	public function getLinkTiposProducto(){
		
		return LinkBuilder::getPageUrl( "TiposProducto") ;
		
	}

	public function getLinkTipoProductoAgregar(){
		
		return LinkBuilder::getPageUrl( "TipoProductoAgregar") ;
		
	}
	
	public function getLinkActionAgregarTipoProducto(){
		
		return LinkBuilder::getActionUrl( "AgregarTipoProducto") ;
		
	}

	public function getLinkActionModificarTipoProducto(){
		
		return LinkBuilder::getActionUrl( "ModificarTipoProducto") ;
		
	}
	
	
	
	public function getLinkMarcasProducto(){
		
		return LinkBuilder::getPageUrl( "MarcasProducto") ;
		
	}

	public function getLinkMarcaProductoAgregar(){
		
		return LinkBuilder::getPageUrl( "MarcaProductoAgregar") ;
		
	}
	
	public function getLinkActionAgregarMarcaProducto(){
		
		return LinkBuilder::getActionUrl( "AgregarMarcaProducto") ;
		
	}

	public function getLinkActionModificarMarcaProducto(){
		
		return LinkBuilder::getActionUrl( "ModificarMarcaProducto") ;
		
	}
	
	public function getLinkIvas(){
		
		return LinkBuilder::getPageUrl( "Ivas") ;
		
	}

	public function getLinkIvaAgregar(){
		
		return LinkBuilder::getPageUrl( "IvaAgregar") ;
		
	}
	
	public function getLinkActionAgregarIva(){
		
		return LinkBuilder::getActionUrl( "AgregarIva") ;
		
	}

	public function getLinkActionModificarIva(){
		
		return LinkBuilder::getActionUrl( "ModificarIva") ;
		
	}
	
	public function getLinkEstados(){
		
		return LinkBuilder::getPageUrl( "Estados") ;
		
	}

	public function getLinkEstadoAgregar(){
		
		return LinkBuilder::getPageUrl( "EstadoAgregar") ;
		
	}
	
	public function getLinkActionAgregarEstado(){
		
		return LinkBuilder::getActionUrl( "AgregarEstado") ;
		
	}

	public function getLinkActionModificarEstado(){
		
		return LinkBuilder::getActionUrl( "ModificarEstado") ;
		
	}
	
	public function getLinkConceptoGastos(){
		
		return LinkBuilder::getPageUrl( "ConceptoGastos") ;
		
	}

	public function getLinkConceptoGastoAgregar(){
		
		return LinkBuilder::getPageUrl( "ConceptoGastoAgregar") ;
		
	}
	
	public function getLinkActionAgregarConceptoGasto(){
		
		return LinkBuilder::getActionUrl( "AgregarConceptoGasto") ;
		
	}

	public function getLinkActionModificarConceptoGasto(){
		
		return LinkBuilder::getActionUrl( "ModificarConceptoGasto") ;
		
	}
	
	public function getLinkConceptoMovimientos(){
		
		return LinkBuilder::getPageUrl( "ConceptoMovimientos") ;
		
	}

	public function getLinkConceptoMovimientoAgregar(){
		
		return LinkBuilder::getPageUrl( "ConceptoMovimientoAgregar") ;
		
	}
	
	public function getLinkActionAgregarConceptoMovimiento(){
		
		return LinkBuilder::getActionUrl( "AgregarConceptoMovimiento") ;
		
	}

	public function getLinkActionModificarConceptoMovimiento(){
		
		return LinkBuilder::getActionUrl( "ModificarConceptoMovimiento") ;
		
	}
	
	public function getLinkClientes(){
		
		return LinkBuilder::getPageUrl( "Clientes") ;
		
	}
	
	public function getLinkClienteAgregar(){
		
		return LinkBuilder::getPageUrl( "ClienteAgregar") ;
		
	}
		
	public function getLinkActionAgregarCliente(){
		
		return LinkBuilder::getActionUrl( "AgregarCliente") ;
		
	}

	public function getLinkActionModificarCliente(){
		
		return LinkBuilder::getActionUrl( "ModificarCliente") ;
		
	}
		
	public function getLinkActionCobrarCuentaCorriente(){
		
		return LinkBuilder::getActionUrl( "CobrarCuentaCorriente") ;
		
	}
	

	public function getLinkProductos(){
		
		return LinkBuilder::getPageUrl( "Productos") ;
		
	}

	public function getLinkProductoAgregar(){
		
		return LinkBuilder::getPageUrl( "ProductoAgregar") ;
		
	}
	
	public function getLinkActionAgregarProducto(){
		
		return LinkBuilder::getActionUrl( "AgregarProducto") ;
		
	}

	public function getLinkActionModificarProducto(){
		
		return LinkBuilder::getActionUrl( "ModificarProducto") ;
		
	}
	
	
	
	public function getLinkServiciosTecnicos(){
		
		return LinkBuilder::getPageUrl( "ServiciosTecnico") ;
		
	}

	public function getLinkServicioTecnicoAgregar(){
		
		return LinkBuilder::getPageUrl( "ServicioTecnicoAgregar") ;
		
	}
	
	public function getLinkActionAgregarServicioTecnico(){
		
		return LinkBuilder::getActionUrl( "AgregarServicioTecnico") ;
		
	}

	public function getLinkActionModificarServicioTecnico(){
		
		return LinkBuilder::getActionUrl( "ModificarServicioTecnico") ;
		
	}

	
	
	
	public function getLinkGastos(){
		
		return LinkBuilder::getPageUrl( "Gastos") ;
		
	}
	
	public function getLinkGastoAgregar($backTo = "GastoPagar"){
		
		
		
		return LinkBuilder::getPageUrl( "GastoAgregar", array("backTo" => $backTo )) ;
		
	}
	
	public function getLinkActionAgregarGasto(){
		
		return LinkBuilder::getActionUrl( "AgregarGasto") ;
		
	}
	
	public function getLinkActionPagarGasto(Gasto $gasto, Cuenta $cuenta, $backTo ="CajaHome"){
		
		
		
		return LinkBuilder::getActionUrl( "PagarGasto", array("gastoOid"=>$gasto->getOid(),
																"cuentaOid"=>$cuenta->getOid(),
																"backTo" => $backTo)) ;
		
	}
	
	public function getLinkGastoAnular(Gasto $gasto){
		
		return LinkBuilder::getPageUrl( "GastoAnular", array("gastoOid"=>$gasto->getOid())) ;
		
	}
	
	public function getLinkActionAnularGasto(Gasto $gasto){
		
		return LinkBuilder::getActionUrl( "AnularGasto", array("gastoOid"=>$gasto->getOid())) ;
		
	}
	
	public function getLinkActionModificarStockProducto(){
		
		return LinkBuilder::getActionUrl( "ModificarStockProducto") ;
		
	}
	
	public function getLinkVentas(){
		
		return LinkBuilder::getPageUrl( "Ventas") ;
		
	}
	
	public function getLinkVentaAgregar($backTo="VentaCobrar"){
		
		return LinkBuilder::getPageUrl( "VentaAgregar", array("backTo" => $backTo )) ;
		
	}
	
	public function getLinkActionAgregarVenta(){
		
		return LinkBuilder::getActionUrl( "AgregarVenta") ;
		
	}

	public function getLinkVentaCobrar(){
		
		return LinkBuilder::getPageUrl( "VentaCobrar") ;
		
	}
	
	public function getLinkActionCobrarVentaEfectivo(Venta $venta){
		
		return LinkBuilder::getActionUrl( "CobrarVentaEfectivo", array("ventaOid"=>$venta->getOid())) ;
		
	}
	
	public function getLinkActionCobrarVentaCtaCte(Venta $venta){
		
		return LinkBuilder::getActionUrl( "CobrarVentaCtaCte", array("ventaOid"=>$venta->getOid())) ;
		
	}
	
	public function getLinkActionCobrarVentaTarjeta(){
		
		return LinkBuilder::getActionUrl( "CobrarVentaTarjeta") ;
		
	}
	
	public function getLinkVentaAnular(Venta $venta){
		
		return LinkBuilder::getPageUrl( "VentaAnular", array("ventaOid"=>$venta->getOid())) ;
		
	}
	
	public function getLinkActionAnularVenta(Venta $venta){
		
		return LinkBuilder::getActionUrl( "AnularVenta", array("ventaOid"=>$venta->getOid())) ;
		
	}
	
	public function getLinkMovimientosCaja(){
		
		return LinkBuilder::getPageUrl( "MovimientosCaja") ;
		
	}
	
	public function getLinkMovimientosCajaTarjeta(){
		
		return LinkBuilder::getPageUrl( "MovimientosCajaTarjeta") ;
		
	}
	
	public function getLinkMovimientosCajaCtaCte(){
		
		return LinkBuilder::getPageUrl( "MovimientosCajaCtaCte") ;
		
	}
	
	public function getLinkMovimientosVenta(){
		
		return LinkBuilder::getPageUrl( "MovimientosVenta") ;
		
	}
	
	public function getLinkMovimientosGasto(){
		
		return LinkBuilder::getPageUrl( "MovimientosGasto") ;
		
	}
	
	public function getLinkMovimientosServicioTecnico(){
		
		return LinkBuilder::getPageUrl( "MovimientosServicioTecnico") ;
		
	}
	
	public function getLinkServicioTecnicoAnular(ServicioTecnico $servicioTecnico){
		
		return LinkBuilder::getPageUrl( "ServicioTecnicoAnular", array("servicioTecnicoOid"=>$servicioTecnico->getOid())) ;
		
	}
	
	public function getLinkActionAnularServicioTecnico(ServicioTecnico $servicioTecnico){
		
		return LinkBuilder::getActionUrl( "AnularServicioTecnico", array("servicioTecnicoOid"=>$servicioTecnico->getOid())) ;
		
	}
	
	public function getLinkActionCobrarServicioTecnicoEfectivo(ServicioTecnico $servicioTecnico){
		
		return LinkBuilder::getActionUrl( "CobrarServicioTecnicoEfectivo", array("servicioTecnicoOid"=>$servicioTecnico->getOid())) ;
		
	}
	
	public function getLinkActionCobrarServicioTecnicoCtaCte(ServicioTecnico $servicioTecnico){
		
		return LinkBuilder::getActionUrl( "CobrarServicioTecnicoCtaCte", array("servicioTecnicoOid"=>$servicioTecnico->getOid())) ;
		
	}
	
	public function getLinkActionCobrarServicioTecnicoTarjeta(){
		
		return LinkBuilder::getActionUrl( "CobrarServicioTecnicoTarjeta") ;
		
	}
	
	public function getLinkCobrarServicioTecnicoTarjeta(ServicioTecnico $servicioTecnico){
		
		return LinkBuilder::getPageUrl( "ServicioTecnicoCobrarTarjeta", array("servicioTecnicoOid"=>$servicioTecnico->getOid())) ;
		
	}
	
	public function getLinkAdminHome(){
		
		return LinkBuilder::getPageUrl( "AdminHome") ;
		
	}
	
	
	
	public function getLinkProveedores(){
		
		return LinkBuilder::getPageUrl( "Proveedores") ;
		
	}
		
	public function getLinkActionAgregarProveedor(){
		
		return LinkBuilder::getActionUrl( "AgregarProveedor") ;
		
	}

	public function getLinkActionModificarProveedor(){
		
		return LinkBuilder::getActionUrl( "ModificarProveedor") ;
		
	}
	
	
	
	
	
	public function getLinkPedidos(){
		
		return LinkBuilder::getPageUrl( "Pedidos") ;
		
	}
	
	public function getLinkPedidoAgregar($backTo = "CajaHome"){
		
		
		
		return LinkBuilder::getPageUrl( "PedidoAgregar", array("backTo" => $backTo )) ;
		
	}
	
	public function getLinkActionAgregarPedido(){
		
		return LinkBuilder::getActionUrl( "AgregarPedido") ;
		
	}
	
	public function getLinkCobrarVentaTarjeta(Venta $venta){
		
		return LinkBuilder::getPageUrl( "VentaCobrarTarjeta", array("ventaOid"=>$venta->getOid())) ;
		
	}
	
	public function getLinkParametros(){
		
		return LinkBuilder::getPageUrl( "Parametros") ;
		
	}
		
	

	public function getLinkActionModificarParametro(){
		
		return LinkBuilder::getActionUrl( "ModificarParametro") ;
		
	}
	
}
?>
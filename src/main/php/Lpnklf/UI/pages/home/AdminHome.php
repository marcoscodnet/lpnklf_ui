<?php
namespace Lpnklf\UI\pages\home;

use Lpnklf\UI\pages\LpnklfPage;

use Lpnklf\UI\components\filter\model\UIEmpleadoCriteria;

use Lpnklf\UI\service\UIServiceFactory;



use Lpnklf\UI\utils\LpnklfUIUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;
use Rasty\utils\LinkBuilder;

use Lpnklf\Core\model\Empleado;

use Rasty\Grid\filter\model\UICriteria;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuActionOption;

use Rasty\security\RastySecurityContext;

class AdminHome extends LpnklfPage{


	
	public function __construct(){

		
		/*if( LpnklfUIUtils::isCajaSelected() ){
			$caja = UIServiceFactory::getUICajaService()->get(LpnklfUIUtils::getCaja()->getOid());
			$this->setCaja( $caja );
		}*/
		
		/*$this->setCajaChica( UIServiceFactory::getUICuentaService()->getCajaChica() );
		
		$this->setCuentaBapro( UIServiceFactory::getUIBancoService()->getCuentaBAPRO() );*/
	}

	public function getTitle(){
		return $this->localize( "admin_home.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
		
	protected function parseMenuUser(XTemplate $xtpl){
		
		$user = RastySecurityContext::getUser();
		$xtpl->assign("user", $user->getName() );
		
		$this->parseMenuExit($xtpl);
		
	}
	
	protected function parseXTemplate(XTemplate $xtpl){
		
		$title = $this->localize("admin_home.title");
		$subtitle = $this->localize("admin_home.subtitle");
		$xtpl->assign("app_title", $title );
		//$xtpl->assign("app_subtitle", $subtitle );
		
		$this->parseMenuUser($xtpl);

		/*$this->parseGastos($xtpl);
		
		$this->parseTareas($xtpl);
		
		$this->parseDebitosCreditos($xtpl);*/
				
		$this->parseLinks($xtpl);
		
		$this->parseSaldos($xtpl);
		
		/*$this->parseStatsVentas($xtpl);*/
	}
	
	public function parseLinks( XTemplate $xtpl){
		
		$xtpl->assign("menu_admin", $this->localize("menu.admin") );
		$xtpl->assign("menu_clientes", $this->localize("menu.clientes") );
		$xtpl->assign("linkClientes", $this->getLinkClientes() );
		$xtpl->assign("menu_clientes_agregar", $this->localize("menu.clientes.agregar") );
		$xtpl->assign("linkClienteAgregar", $this->getLinkClienteAgregar() );
		
		/*$xtpl->assign("menu_empleados", $this->localize("menu.empleados") );
		$xtpl->assign("linkEmpleados", $this->getLinkEmpleados());
		
		$xtpl->assign("menu_proveedores", $this->localize("menu.proveedores") );
		$xtpl->assign("linkProveedores", $this->getLinkProveedores() );
		
		$xtpl->assign("menu_pedidos", $this->localize("menu.pedidos") );
		$xtpl->assign("linkPedidos", $this->getLinkPedidos() );
		$xtpl->assign("total_pedidosPendientes", UIServiceFactory::getUIPedidoService()->getTotalPendientes() );
		$xtpl->assign("menu_pedidos_agregar", $this->localize("menu.pedidos.agregar") );
		$xtpl->assign("linkPedidoAgregar", $this->getLinkPedidoAgregar() );*/
		
		$xtpl->assign("menu_ventas", $this->localize("menu.ventas") );
		$xtpl->assign("linkVentas", $this->getLinkVentas() );
		
		$xtpl->assign("menu_productos", $this->localize("menu.productos") );
		$xtpl->assign("linkProductos", $this->getLinkProductos() );
		$xtpl->assign("menu_productos_agregar", $this->localize("menu.productos.agregar") );
		$xtpl->assign("linkProductoAgregar", $this->getLinkProductoAgregar() );
		
		$xtpl->assign("menu_servicios_tecnicos", $this->localize("menu.servicios_tecnicos") );
		$xtpl->assign("linkServicioTecnicos", $this->getLinkServiciosTecnicos() );
		$xtpl->assign("menu_servicios_tecnicos_agregar", $this->localize("menu.servicios_tecnicos.agregar") );
		$xtpl->assign("linkServicioTecnicoAgregar", $this->getLinkServicioTecnicoAgregar() );
		
		$xtpl->assign("menu_gastos", $this->localize("menu.gastos") );
		$xtpl->assign("linkGastos", $this->getLinkGastos() );
		$xtpl->assign("menu_gastos_agregar", $this->localize("menu.gastos.agregar") );
		$xtpl->assign("linkGastoAgregar", $this->getLinkGastoAgregar() );
		
		/*$xtpl->assign("menu_tareas", $this->localize("menu.tareas") );
		$xtpl->assign("linkTareas", $this->getLinkTareas() );*/
		//$xtpl->assign("total_tareasPendientes", UIServiceFactory::getUITareaService()->getTotalPendientes() );
		
		$xtpl->assign("menu_stock", $this->localize("menu.stock") );
		$xtpl->assign("menu_productos", $this->localize("menu.productos") );
		$xtpl->assign("linkProductos", $this->getLinkProductos() );
		
		$xtpl->assign("menu_ventasProductos", $this->localize("menu.ventasProductos") );
		$xtpl->assign("linkVentas", $this->getLinkVentas() );
		
		$xtpl->assign("menu_ventas_agregar", $this->localize("menu.ventas.agregar") );
		$xtpl->assign("linkVentaAgregar", $this->getLinkVentaAgregar() );
		
		
		$xtpl->assign("menu_ventasST", $this->localize("menu.ventasST") );
		//$xtpl->assign("linkMovimientosServicioTecnicos", $this->getLinkMovimientosServicioTecnicos() );
		
		/*$xtpl->assign("menu_ctasctes", $this->localize("menu.cuentasCorrientes") );
		
		$xtpl->assign("menu_sucursales", $this->localize("menu.sucursales") );
		$xtpl->assign("linkSucursales", $this->getLinkSucursales() );
		
		$xtpl->assign("menu_premios", $this->localize("menu.pagoPremios") );
		$xtpl->assign("linkPremios", $this->getLinkPagoPremios() );
		$xtpl->assign("linkPagoPremioAgregar", $this->getLinkPagoPremioAgregar() );
		$xtpl->assign("menu_premios_agregar", $this->localize("menu.pagoPremios.agregar") );
		
		
		$xtpl->assign("menu_balance_caja", $this->localize("menu.balances.caja") );
		$xtpl->assign("linkBalanceCaja", $this->getLinkBalanceCaja() );
		
		$xtpl->assign("menu_balance_dia", $this->localize("menu.balances.dia") );
		$xtpl->assign("linkBalanceDia", $this->getLinkBalanceDia() );
		
		$xtpl->assign("menu_balance_mes", $this->localize("menu.balances.mes") );
		$xtpl->assign("linkBalanceMes", $this->getLinkBalanceMes() );
		
		$xtpl->assign("menu_balance_anio", $this->localize("menu.balances.anio") );
		$xtpl->assign("linkBalanceAnio", $this->getLinkBalanceAnio() );*/
		
		$xtpl->assign("menu_cuentas", $this->localize("menu.cuentas") );
		$xtpl->assign("menu.ventasST", $this->localize("menu.ventasST") );
		//$xtpl->assign("linkCaja", $this->getLinkCajaHome());
				
		$xtpl->assign("menu_caja", $this->localize("menu.caja") );
		$xtpl->assign("menu_cajaTarjeta", $this->localize("menu.cajaTarjeta") );
		$xtpl->assign("menu_cajaCtaCte", $this->localize("menu.cajaCtaCte") );
		
		/*$xtpl->assign("menu_informes", $this->localize("admin_home.informes") );
		
		$xtpl->assign("menu_informesSemanales", $this->localize("admin_home.informesSemanales") );
		$xtpl->assign("linkInformesSemanales", $this->getLinkInformesSemanales() );
		
		$xtpl->assign("menu_informesDiariosDebitoCredito", $this->localize("admin_home.informesDiariosDebitoCredito") );
		$xtpl->assign("linkInformesDiariosDebitoCredito", $this->getLinkInformesDiariosDebitoCredito() );
		
		$xtpl->assign("menu_informesDiariosComision", $this->localize("admin_home.informesDiariosComision") );
		$xtpl->assign("linkInformesDiariosComision", $this->getLinkInformesDiariosComision() );
		
		$xtpl->assign("menu_informesStats", $this->localize("admin_home.informesStats") );
		$xtpl->assign("linkInformesStats", $this->getLinkInformesStats() );

		$xtpl->assign("lbl_sorteos",  $this->localize( "menu.sorteos" ) );
		$xtpl->assign("linkSorteos", $this->getLinkSorteos() );*/
	}
	
	public function parseStatsVentas(XTemplate $xtpl){
		
		$totalesDia = UIServiceFactory::getUIVentaService()->getTotalesDia(new \Datetime());
		$xtpl->assign("monto_ventas_label", $this->localize("venta.stats.dia.monto") );
		$xtpl->assign("monto_ventas", LpnklfUIUtils::formatMontoToView($totalesDia["monto"]) );
		$xtpl->assign("total_ventas_label", $this->localize("venta.stats.dia.cantidad") );
		$xtpl->assign("total_ventas", $totalesDia["cantidad"] );
		$xtpl->assign("linkBalanceDia", $this->getLinkBalanceDia());
		
		$totalesMes = UIServiceFactory::getUIVentaService()->getTotalesMes(new \Datetime());
		$xtpl->assign("monto_ventas_mes_label", $this->localize("venta.stats.mes.monto") );
		$xtpl->assign("monto_ventas_mes", LpnklfUIUtils::formatMontoToView($totalesMes["monto"]) );
		
		
		
	}
	
	
	public function parseInformes(XTemplate $xtpl){
		
		$totalesDia = UIServiceFactory::getUIVentaService()->getTotalesDia(new \Datetime());
		
		$xtpl->assign("total_ventas_label", $this->localize("venta.stats.dia.cantidad") );
		$xtpl->assign("total_ventas", $totalesDia["cantidad"] );
		$xtpl->assign("linkBalanceDia", $this->getLinkBalanceDia());
		
		$totalesMes = UIServiceFactory::getUIVentaService()->getTotalesMes(new \Datetime());
		$xtpl->assign("monto_ventas_mes_label", $this->localize("venta.stats.mes.monto") );
		$xtpl->assign("monto_ventas_mes", LpnklfUIUtils::formatMontoToView($totalesMes["monto"]) );
		
	}
	
	public function parseDebitosCreditos( XTemplate $xtpl){
	
		$debitosCreditos = UIServiceFactory::getUIInformeDiarioDebitoCreditoService()->getDebitosCreditosPendientes();
	
		if(count($debitosCreditos) == 0 ){
			$xtpl->assign("titulo", $this->localize("admin_home.debitoCreditos.vacio") );
			$xtpl->parse("main.sin_debitoCredito");
		}
	
		foreach ($debitosCreditos as $informeDebitoCredito) {
			
			$xtpl->assign("titulo", LpnklfUIUtils::formatDateToView( $informeDebitoCredito->getFechaVencimiento()) );
			
			if($informeDebitoCredito->getDebito()){
				$xtpl->assign("subtitulo", LpnklfUIUtils::formatMontoToView($informeDebitoCredito->getDebito()) );
				$xtpl->assign("descripcion", "Débito" );
			}else{
				$xtpl->assign("subtitulo", LpnklfUIUtils::formatMontoToView($informeDebitoCredito->getCredito()) );
				$xtpl->assign("descripcion", "Crédito" );
			}
						
			
			$xtpl->parse("main.debitoCredito");
			
		}
	
		$xtpl->assign("total_debitosCreditos", count($debitosCreditos));
	
	}
	
	public function parseSaldos(XTemplate $xtpl){
		
		//if( LpnklfUIUtils::isCajaSelected() ){
			
			
			$xtpl->assign("saldo_caja", LpnklfUIUtils::formatMontoToView( UIServiceFactory::getUIMovimientoCajaService()->getTotalesDia(new \Datetime())) );
			$xtpl->assign("saldo_ventas", LpnklfUIUtils::formatMontoToView( UIServiceFactory::getUIMovimientoVentaService()->getTotalesDia(new \Datetime())) );
			$xtpl->assign("saldo_gastos", LpnklfUIUtils::formatMontoToView( UIServiceFactory::getUIMovimientoGastoService()->getTotalesDia(new \Datetime())) );
			$xtpl->assign("saldo_ventaST", LpnklfUIUtils::formatMontoToView( UIServiceFactory::getUIMovimientoServicioTecnicoService()->getTotalesDia(new \Datetime())) );
			$xtpl->assign("saldo_cajaTarjeta", LpnklfUIUtils::formatMontoToView( UIServiceFactory::getUIMovimientoCajaService()->getTotalesTarjetasDia(new \Datetime())) );
			$xtpl->assign("saldo_cajaCtaCte", LpnklfUIUtils::formatMontoToView( UIServiceFactory::getUIMovimientoCajaService()->getTotalesCtasCtesDia(new \Datetime())) );
			
			$xtpl->assign("linkMovimientosCaja", $this->getLinkMovimientosCaja());
			$xtpl->assign("linkMovimientosCajaTarjeta", $this->getLinkMovimientosCajaTarjeta());
			$xtpl->assign("linkMovimientosCajaCtaCte", $this->getLinkMovimientosCajaCtaCte());
			$xtpl->assign("linkMovimientosVentas", $this->getLinkMovimientosVenta());
			$xtpl->assign("linkMovimientosGastos", $this->getLinkMovimientosGasto());
			$xtpl->assign("linkMovimientosServicioTecnicos", $this->getLinkMovimientosServicioTecnico());
			
			
		/*}else{
			$xtpl->assign("saldo_caja", LpnklfUIUtils::formatMontoToView( 0) );
		}*/
		
		/*$xtpl->assign("saldo_cajaChica", LpnklfUIUtils::formatMontoToView( $this->getCajaChica()->getSaldo() ) );
		$xtpl->assign("linkMovimientosCajaChica", $this->getLinkMovimientosCajaChica());
		
		$xtpl->assign("saldo_bancos", LpnklfUIUtils::formatMontoToView( UIServiceFactory::getUIBancoService()->getSaldoBancos() ) );
		$xtpl->assign("linkMovimientosBanco", $this->getLinkMovimientosBanco());

		$xtpl->assign("saldo_ctasctes", LpnklfUIUtils::formatMontoToView( UIServiceFactory::getUICuentaCorrienteService()->getSaldoCtasCtes() ) );
	*/
	}
	
	
	public function parseMenuExit( XTemplate $xtpl){
	
		$menuOption = new MenuActionOption();
		$menuOption->setLabel( $this->localize( "menu.logout") );
		$menuOption->setIconClass( "icon-exit" );
		$menuOption->setActionName( "Logout");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/logout.png" );
	
		$this->parseMenuOption($xtpl, $menuOption, "main.menuOptionExit");
	
	}
	
	public function parseMenuAdmin( XTemplate $xtpl){
	
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.admin_home") );
		//$menuOption->setIconClass( "icon-exit" );
		$menuOption->setPageName( "AdminHome");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/empleado_home_48.png" );
	
		$this->parseMenuOption($xtpl, $menuOption, "main.menuOptionAdmin");
	
	}
	public function parseMenuProfile( XTemplate $xtpl, $user){
	
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.profile") );
		$menuOption->setIconClass( "icon-cog" );
		$menuOption->setPageName( "UserProfile");
		$menuOption->addParam("oid",$user->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/profile.png" );
		$this->parseMenuOption($xtpl, $menuOption, "main.menuOptionProfile");
	
	}
	
	public function parseMenuOption( XTemplate $xtpl, MenuOption $menuOption, $blockName){
		$xtpl->assign("label", $menuOption->getLabel() );
		$xtpl->assign("onclick", $menuOption->getOnclick());
		$img = $menuOption->getImageSource();
		if(!empty($img)){
			$xtpl->assign("src", $img );
			$xtpl->parse("$blockName.image");
		}
		$xtpl->assign("iconClass", $menuOption->getIconClass());
	
		$xtpl->parse("$blockName");
	}
	
	public function parseGastos( XTemplate $xtpl){
		
		$gastos = UIServiceFactory::getUIGastoService()->getGastosPorVencer();
		
		if(count($gastos) == 0 ){
			$xtpl->assign("titulo", $this->localize("gastos.por_vencer.vacio") );
			$xtpl->parse("main.sin_gasto");
		}
		
		foreach ($gastos as $gasto) {
			$xtpl->assign("titulo", LpnklfUIUtils::formatDateToView( $gasto->getFechaVencimiento()) );
			$xtpl->assign("subtitulo", LpnklfUIUtils::formatMontoToView($gasto->getMonto()) );
			$xtpl->assign("descripcion", $gasto->getConcepto() );
			$xtpl->parse("main.gasto");
		}
		
		$xtpl->assign("total_gastos", count($gastos));
		
	}
	
	public function parseTareas( XTemplate $xtpl){
		
		$tareas = UIServiceFactory::getUITareaService()->getTareasPendientes();
		
		if(count($tareas) == 0 ){
			$xtpl->assign("titulo", $this->localize("tareas.pendientes.vacio") );
			$xtpl->parse("main.sin_tarea");
		}
		
		foreach ($tareas as $tarea) {
			$xtpl->assign("titulo", LpnklfUIUtils::formatDateToView( $tarea->getFechaHora()) );
			$xtpl->assign("subtitulo", $tarea->getTitulo() );
			$xtpl->assign("descripcion", $tarea->getObservaciones() );
			$xtpl->parse("main.tarea");
		}
		
		$xtpl->assign("total_tareasPendientes", count($tareas));
		
	}
	
	
	public function getType(){

		return "AdminHome";

	}


	
}
?>
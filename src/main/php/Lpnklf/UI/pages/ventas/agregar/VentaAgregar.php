<?php
namespace Lpnklf\UI\pages\ventas\agregar;

use Lpnklf\Core\utils\LpnklfUtils;
use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\pages\LpnklfPage;

use Rasty\utils\XTemplate;
use Lpnklf\Core\model\Venta;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class VentaAgregar extends LpnklfPage{

	/**
	 * venta a agregar.
	 * @var Venta
	 */
	private $venta;

	
	public function __construct(){
		
		//inicializamos el venta.
		$venta = new Venta();
		
		$venta->setFecha( new \Datetime() );
		
		//$venta->setCliente( LpnklfUtils::getClienteDefault() );
		
		$this->setVenta($venta);

		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("Ventas");
//		$menuGroup->addMenuOption( $menuOption );
//		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "venta.agregar.title" );
	}

	public function getType(){
		
		return "VentaAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		LpnklfUIUtils::setDetallesVentaSession( array() );
	}


	public function getVenta()
	{
	    return $this->venta;
	}

	public function setVenta($venta)
	{
	    $this->venta = $venta;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>
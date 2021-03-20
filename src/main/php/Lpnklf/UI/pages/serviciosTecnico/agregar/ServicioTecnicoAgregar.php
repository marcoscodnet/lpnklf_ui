<?php
namespace Lpnklf\UI\pages\serviciosTecnico\agregar;

use Lpnklf\Core\utils\LpnklfUtils;

use Lpnklf\UI\pages\LpnklfPage;

use Rasty\utils\XTemplate;
use Lpnklf\Core\model\ServicioTecnico;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\utils\RastyUtils;
use Lpnklf\UI\service\UIServiceFactory;

class ServicioTecnicoAgregar extends LpnklfPage{

	/**
	 * servicioTecnico a agregar.
	 * @var ServicioTecnico
	 */
	private $servicioTecnico;

	
	public function __construct(){
		
		//inicializamos el servicioTecnico.
		$servicioTecnico = new ServicioTecnico();
		$servicioTecnico->setFecha( new \Datetime() );
		$servicioTecnico->setTipoProducto(LpnklfUtils::getTipoProductoDefault() );
		$servicioTecnico->setMarcaProducto(LpnklfUtils::getMarcaProductoDefault() );
		
		if(RastyUtils::getParamGET("clienteOid") ){
			$cliente = UIServiceFactory::getUIClienteService()->get( RastyUtils::getParamGET("clienteOid") );
			$servicioTecnico->setCliente($cliente );
		}
		
		$this->setServicioTecnico($servicioTecnico);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("ServiciosTecnico");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "servicioTecnico.agregar.title" );
	}

	public function getType(){
		
		return "ServicioTecnicoAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$servicioTecnicoForm = $this->getComponentById("servicioTecnicoForm");
		$servicioTecnicoForm->fillFromSaved( $this->getServicioTecnico() );
		
	}


	public function getServicioTecnico()
	{
	    return $this->servicioTecnico;
	}

	public function setServicioTecnico($servicioTecnico)
	{
	    $this->servicioTecnico = $servicioTecnico;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>
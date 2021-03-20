<?php
namespace Lpnklf\UI\pages\serviciosTecnico\modificar;

use Lpnklf\UI\pages\LpnklfPage;

use Lpnklf\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Lpnklf\Core\model\ServicioTecnico;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

use Rasty\utils\RastyUtils;

class ServicioTecnicoModificar extends LpnklfPage{

	/**
	 * servicioTecnico a modificar.
	 * @var ServicioTecnico
	 */
	private $servicioTecnico;

	
	public function __construct(){
		
		//inicializamos el servicioTecnico.
		$servicioTecnico = new ServicioTecnico();
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
		
		return array($menuGroup);
	}
	
	public function setServicioTecnicoOid($oid){
		
		//a partir del id buscamos el servicioTecnico a modificar.
		$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get($oid);
		
		$this->setServicioTecnico($servicioTecnico);
		
	}
	
	public function getTitle(){
		return $this->localize( "servicioTecnico.modificar.title" );
	}

	public function getType(){
		
		return "ServicioTecnicoModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}

	public function getServicioTecnico(){
		
	    return $this->servicioTecnico;
	}

	public function setServicioTecnico($servicioTecnico)
	{
	    $this->servicioTecnico = $servicioTecnico;
	}
}
?>
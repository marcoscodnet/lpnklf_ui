<?php
namespace Lpnklf\UI\pages\estados\modificar;

use Lpnklf\UI\pages\LpnklfPage;

use Lpnklf\UI\service\UIServiceFactory;

use Rasty\utils\XTemplate;
use Lpnklf\Core\model\Estado;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class EstadoModificar extends LpnklfPage{

	/**
	 * estado a modificar.
	 * @var Estado
	 */
	private $estado;

	
	public function __construct(){
		
		//inicializamos el estado.
		$estado = new Estado();
		$this->setEstado($estado);
				
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		return array($menuGroup);
	}
	
	public function setEstadoOid($oid){
		
		//a partir del id buscamos el estado a modificar.
		$estado = UIServiceFactory::getUIEstadoService()->get($oid);
		
		$this->setEstado($estado);
		
	}
	
	public function getTitle(){
		return $this->localize( "estado.modificar.title" );
	}

	public function getType(){
		
		return "EstadoModificar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
	}

	public function getEstado(){
		
	    return $this->estado;
	}

	public function setEstado($estado)
	{
	    $this->estado = $estado;
	}
}
?>
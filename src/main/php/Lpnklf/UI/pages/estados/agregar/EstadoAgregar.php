<?php
namespace Lpnklf\UI\pages\estados\agregar;

use Lpnklf\UI\pages\LpnklfPage;

use Rasty\utils\XTemplate;
use Lpnklf\Core\model\Estado;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class EstadoAgregar extends LpnklfPage{

	/**
	 * Estado a agregar.
	 * @var Estado
	 */
	private $Estado;

	
	public function __construct(){
		
		//inicializamos el Estado.
		$Estado = new Estado();
		
		//$Estado->setNombre("Bernardo");
		//$Estado->setEmail("ber@mail.com");
		$this->setEstado($Estado);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("Estados");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "estado.agregar.title" );
	}

	public function getType(){
		
		return "EstadoAgregar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$estadoForm = $this->getComponentById("estadoForm");
		$estadoForm->fillFromSaved( $this->getEstado() );
		
	}


	public function getEstado()
	{
	    return $this->Estado;
	}

	public function setEstado($Estado)
	{
	    $this->Estado = $Estado;
	}
	
	
					
	public function getMsgError(){
		return "";
	}
}
?>
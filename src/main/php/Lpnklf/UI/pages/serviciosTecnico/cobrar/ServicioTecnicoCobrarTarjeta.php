<?php
namespace Lpnklf\UI\pages\serviciosTecnico\cobrar;

use Lpnklf\UI\pages\LpnklfPage;

use Rasty\utils\XTemplate;
use Lpnklf\Core\model\Tarjeta;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class ServicioTecnicoCobrarTarjeta extends LpnklfPage{

	/**
	 * Tarjeta a agregar.
	 * @var Tarjeta
	 */
	private $Tarjeta;

	
	public function __construct(){
		
		//inicializamos el Tarjeta.
		$Tarjeta = new Tarjeta();
		
		
		$this->setTarjeta($Tarjeta);
		
		
	}
	
	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		
		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "cobrarTarjeta.title" );
	}

	public function getType(){
		
		return "ServicioTecnicoCobrarTarjeta";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		$servicioTecnicoCobrarTarjetaForm = $this->getComponentById("servicioTecnicoCobrarTarjetaForm");
		$servicioTecnicoCobrarTarjetaForm->fillFromSaved( $this->getTarjeta() );
		
	}


	
	
	
					
	public function getMsgError(){
		return "";
	}

	public function getTarjeta()
	{
	    return $this->Tarjeta;
	}

	public function setTarjeta($Tarjeta)
	{
	    $this->Tarjeta = $Tarjeta;
	}
}
?>
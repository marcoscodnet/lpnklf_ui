<?php
namespace Lpnklf\UI\pages\clientes;

use Lpnklf\UI\pages\LpnklfPage;

use Lpnklf\UI\components\filter\model\UIClienteCriteria;

use Lpnklf\UI\components\grid\model\ClienteGridModel;

use Lpnklf\UI\service\UIClienteService;

use Lpnklf\UI\utils\LpnklfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Lpnklf\Core\model\Cliente;
use Lpnklf\Core\criteria\ClienteCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los clientes.
 * 
 * @author Marcos
 * @since 02/03/2018
 * 
 */
class Clientes extends LpnklfPage{

	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "clientes.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "cliente.agregar") );
		$menuOption->setPageName("ClienteAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.cobrarCuentaCorriente") );
		$menuOption->setPageName("CobrarCtaCte");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/cobros_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Clientes";
		
	}	

	public function getModelClazz(){
		return get_class( new ClienteGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIClienteCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("agregar_label", $this->localize("cliente.agregar") );
	}

}
?>
<?php
namespace Lpnklf\UI\pages\estados;

use Lpnklf\UI\service\UIServiceFactory;

use Lpnklf\UI\components\filter\model\UIEstadoCriteria;

use Lpnklf\UI\components\grid\model\EstadoGridModel;

use Lpnklf\UI\pages\LpnklfPage;

use Lpnklf\UI\utils\LpnklfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los movimientos de banco.
 * 
 * @author Marcos
 * @since 05-03-2018
 * 
 */
class Estados extends LpnklfPage{

	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "estado.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "estado.agregar") );
		$menuOption->setPageName("EstadoAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Estados";
		
	}	

	public function getModelClazz(){
		return get_class( new EstadoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIEstadoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("agregar_label", $this->localize("estado.agregar") );
	}


}
?>
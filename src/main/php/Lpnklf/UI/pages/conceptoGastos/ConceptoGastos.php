<?php
namespace Lpnklf\UI\pages\conceptoGastos;

use Lpnklf\UI\service\UIServiceFactory;

use Lpnklf\UI\components\filter\model\UIConceptoGastoCriteria;

use Lpnklf\UI\components\grid\model\ConceptoGastoGridModel;

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
 * @since 12-03-2018
 * 
 */
class ConceptoGastos extends LpnklfPage{

	
	public function __construct(){
		
	}
	
	public function getTitle(){
		return $this->localize( "conceptoGasto.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "conceptoGasto.agregar") );
		$menuOption->setPageName("ConceptoGastoAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "ConceptoGastos";
		
	}	

	public function getModelClazz(){
		return get_class( new ConceptoGastoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIConceptoGastoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("agregar_label", $this->localize("conceptoGasto.agregar") );
	}


}
?>
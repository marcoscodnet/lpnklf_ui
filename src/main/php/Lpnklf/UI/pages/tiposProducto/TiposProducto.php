<?php
namespace Lpnklf\UI\pages\tiposProducto;

use Lpnklf\UI\service\UIServiceFactory;

use Lpnklf\UI\components\filter\model\UITipoProductoCriteria;

use Lpnklf\UI\components\grid\model\TipoProductoGridModel;

use Lpnklf\Core\criteria\TipoProductoCriteria;

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
class TiposProducto extends LpnklfPage{

	
	private $tipoProductoCriteria;
	
	public function __construct(){
		$tipoProductoCriteria = new TipoProductoCriteria();
		
		
		$this->setTipoProductoCriteria($tipoProductoCriteria);
	}
	
	public function getTitle(){
		return $this->localize( "tipoProducto.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "tipoProducto.agregar") );
		$menuOption->setPageName("TipoProductoAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "TiposProducto";
		
	}	

	public function getModelClazz(){
		return get_class( new TipoProductoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UITipoProductoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("agregar_label", $this->localize("tipoProducto.agregar") );
		$productoFilter = $this->getComponentById("tiposProductoFilter");
		//print_r($productoFilter);
		$productoFilter->fillFromSaved( $this->getTipoProductoCriteria() );
	}
	
	public function getTipoProductoCriteria()
	{
	    return $this->tipoProductoCriteria;
	}

	public function setTipoProductoCriteria($tipoProductoCriteria)
	{
	    $this->tipoProductoCriteria = $tipoProductoCriteria;
	}


}
?>
<?php
namespace Lpnklf\UI\pages\productos;

use Lpnklf\UI\pages\LpnklfPage;

use Lpnklf\UI\components\filter\model\UIProductoCriteria;

use Lpnklf\UI\components\grid\model\ProductoGridModel;

use Lpnklf\UI\service\UIProductoService;

use Lpnklf\UI\utils\LpnklfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Lpnklf\Core\model\Producto;
use Lpnklf\Core\criteria\ProductoCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los productos.
 * 
 * @author Marcos
 * @since 06/03/2018
 * 
 */
class Productos extends LpnklfPage{

	
	
	private $productoCriteria;
	
	public function __construct(){
		$productoCriteria = new ProductoCriteria();
		
		
		$this->setProductoCriteria($productoCriteria);
	}
	
	public function getTitle(){
		return $this->localize( "productos.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "producto.agregar") );
		$menuOption->setPageName("ProductoAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "Productos";
		
	}	

	public function getModelClazz(){
		return get_class( new ProductoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIProductoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		$xtpl->assign("agregar_label", $this->localize("producto.agregar") );
		
		$productoFilter = $this->getComponentById("productosFilter");
		//print_r($productoFilter);
		$productoFilter->fillFromSaved( $this->getProductoCriteria() );
	}
	
	public function getProductoCriteria()
	{
	    return $this->productoCriteria;
	}

	public function setProductoCriteria($productoCriteria)
	{
	    $this->productoCriteria = $productoCriteria;
	}

}
?>
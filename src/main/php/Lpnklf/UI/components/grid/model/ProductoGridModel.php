<?php
namespace Lpnklf\UI\components\grid\model;

use Lpnklf\UI\components\grid\formats\GridImporteFormat;
use Lpnklf\UI\components\grid\formats\GridPrecioListaFormat;
use Lpnklf\UI\components\grid\formats\GridPrecioEfectivoFormat;
use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\components\filter\model\UIProductoCriteria;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;

use Lpnklf\Core\utils\LpnklfUtils;

use Lpnklf\UI\service\UIServiceFactory;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;
use Rasty\security\RastySecurityContext;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

/**
 * Model para la grilla de productos.
 *
 * @author Marcos
 * @since 06/03/2018
 */
class ProductoGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();

    }

    public function getService(){

    	return UIServiceFactory::getUIProductoService();
    }

    public function getFilter(){

    	$filter = new UIProductoCriteria();
		return $filter;
    }

	protected function initModel() {

		$this->setHasCheckboxes( false );

		$column = GridModelBuilder::buildColumn( "oid", "producto.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "nombre", "producto.nombre", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "tipoProducto", "producto.tipoProducto", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "marcaProducto", "producto.marcaProducto", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "stock", "producto.stock", 10, EntityGrid::TEXT_ALIGN_RIGHT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "stockMinimo", "producto.stockMinimo", 10, EntityGrid::TEXT_ALIGN_RIGHT ) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "costo", "producto.costo", 10, EntityGrid::TEXT_ALIGN_RIGHT ,  new GridImporteFormat()) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "precioEfectivo", "producto.precioEfectivo", 10, EntityGrid::TEXT_ALIGN_RIGHT  ,  new GridImporteFormat()) ;
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "precioLista", "producto.precioLista", 10, EntityGrid::TEXT_ALIGN_RIGHT ,  new GridImporteFormat()) ;
		$this->addColumn( $column );



	}

	public function getDefaultFilterField() {
        return "nombre";
    }

	public function getDefaultOrderField(){
		return "nombre";
	}


    /**
	 * opciones de menú dado el item
	 * @param unknown_type $item
	 */
	public function getMenuGroups( $item ){

		$group = new MenuGroup();
		$group->setLabel("grupo");
		$options = array();

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.productos.modificar") );
		$menuOption->setPageName( "ProductoModificar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/editar_32.png" );
		$options[] = $menuOption ;






		$menuOption = new MenuActionAjaxOption();
		$menuOption->setLabel( $this->localize( "menu.producto.eliminar") );
		$menuOption->setActionName( "EliminarProducto" );
		$menuOption->setConfirmMessage( $this->localize( "producto.eliminar.confirm.msg") );
		$menuOption->setConfirmTitle( $this->localize( "producto.eliminar.confirm.title") );
		$menuOption->setOnSuccessCallback( "eliminarCallback" );
		$menuOption->addParam("productoOid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/eliminar_32.png" );
		$options[] = $menuOption ;

		$group->setMenuOptions( $options );

		return array( $group );

	}

}
?>

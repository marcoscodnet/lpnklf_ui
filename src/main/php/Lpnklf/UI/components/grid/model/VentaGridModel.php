<?php
namespace Lpnklf\UI\components\grid\model;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\components\grid\formats\GridImporteFormat;

use Lpnklf\UI\components\grid\formats\GridEstadoVentaFormat;

use Lpnklf\UI\components\filter\model\UIVentaCriteria;

use Lpnklf\Core\model\EstadoVenta;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;
use Rasty\Grid\entitygrid\model\GridDatetimeFormat;
use Lpnklf\UI\service\UIServiceFactory;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

/**
 * Model para la grilla de Ventas.
 * 
 * @author Bernardo
 * @since 13-06-2014
 */
class VentaGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();
        
    }
    
    public function getService(){
    	
    	return UIServiceFactory::getUIVentaService();
    }
    
    public function getFilter(){
	    
    	$filter = new UIVentaCriteria();
		return $filter;    	
    }
        
	protected function initModel() {

		$this->setHasCheckboxes( false );
		
		$column = GridModelBuilder::buildColumn( "oid", "venta.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "fecha", "venta.fecha", 20, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y H:i:s") );
		$this->addColumn( $column );
		
		
		
		$column = GridModelBuilder::buildColumn( "cliente", "venta.cliente", 20, EntityGrid::TEXT_ALIGN_LEFT );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "monto", "venta.monto", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$column->setCssClass("importe");
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "montoPagado", "venta.montoPagado", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$column->setCssClass("importe");
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "montoDebe", "venta.montoDebe", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$column->setCssClass("importe");
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "observaciones", "venta.observaciones", 20, EntityGrid::TEXT_ALIGN_LEFT );
		$this->addColumn( $column );

		$column = GridModelBuilder::buildColumn( "estado", "venta.estado", 20, EntityGrid::TEXT_ALIGN_LEFT, new GridEstadoVentaFormat() );
		$this->addColumn( $column );
				
		
	}

	public function getRowStyleClass($item){
		
		return LpnklfUIUtils::getEstadoVentaCss($item->getEstado());
		
	}
	
	public function getDefaultFilterField() {
        return "fecha";
    }

	public function getDefaultOrderField(){
		return "fecha";
	}    

	public function getDefaultOrderType(){
		return "DESC";
	}
	
    /**
	 * opciones de menú dado el item
	 * @param unknown_type $item
	 */
	public function getMenuGroups( $item ){
	
		$group = new MenuGroup();
		$group->setLabel("grupo");
		$options = array();
		
		if( $item->podesAnularte() ){
			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( "menu.ventas.anular") );
			$menuOption->setPageName( "VentaAnular" );
			$menuOption->addParam("ventaOid",$item->getOid());
			$menuOption->setIconClass( "icon-anular" );
			$options[] = $menuOption ;
		}
		
		if( $item->podesCobrarte() ){
			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( "menu.ventas.cobrar") );
			$menuOption->setPageName( "VentaCobrar" );
			$menuOption->addParam("ventaOid",$item->getOid());
			$menuOption->setIconClass( "icon-cobrar-venta fg-green" );
			$options[] = $menuOption ;
		}
		
		
		$group->setMenuOptions( $options );
		
		return array( $group );
		
	} 
    
}
?>
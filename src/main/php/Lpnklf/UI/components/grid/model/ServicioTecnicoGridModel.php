<?php
namespace Lpnklf\UI\components\grid\model;

use Lpnklf\UI\components\grid\formats\GridPrioridadFormat;

use Lpnklf\UI\components\grid\formats\GridEstadoVentaFormat;

use Lpnklf\UI\components\grid\formats\GridImporteFormat;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\components\filter\model\UIServicioTecnicoCriteria;

use Rasty\Grid\entitygrid\EntityGrid;
use Rasty\Grid\entitygrid\model\EntityGridModel;
use Rasty\Grid\entitygrid\model\GridModelBuilder;
use Rasty\Grid\filter\model\UICriteria;

use Lpnklf\Core\utils\LpnklfUtils;
use Rasty\Grid\entitygrid\model\GridDatetimeFormat;
use Lpnklf\UI\service\UIServiceFactory;
use Rasty\utils\RastyUtils;
use Rasty\utils\Logger;
use Rasty\security\RastySecurityContext;

use Rasty\Menu\menu\model\MenuOption;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuActionOption;
use Rasty\Menu\menu\model\MenuActionAjaxOption;

/**
 * Model para la grilla de serviciosTecnico.
 * 
 * @author Marcos
 * @since 08/03/2018
 */
class ServicioTecnicoGridModel extends EntityGridModel{

	public function __construct() {

        parent::__construct();
        $this->initModel();
        
    }
    
    public function getService(){
    	
    	return UIServiceFactory::getUIServicioTecnicoService();
    }
    
    public function getFilter(){
    	
    	$filter = new UIServicioTecnicoCriteria();
		return $filter;    	
    }
        
	protected function initModel() {

		$this->setHasCheckboxes( false );
		
		$column = GridModelBuilder::buildColumn( "oid", "servicioTecnico.oid", 20, EntityGrid::TEXT_ALIGN_RIGHT );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "fecha", "servicioTecnico.fecha", 10, EntityGrid::TEXT_ALIGN_CENTER, new GridDatetimeFormat("d/m/Y H:i") ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "cliente", "servicioTecnico.cliente", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "cliente.celular", "cliente.celular", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "tipoProducto", "servicioTecnico.tipoProducto", 10, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "marcaProducto", "servicioTecnico.marcaProducto", 30, EntityGrid::TEXT_ALIGN_LEFT ) ;
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "monto", "servicioTecnico.monto", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat());
		$column->setCssClass("importe");
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "montoPagado", "servicioTecnico.montoPagado", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$column->setCssClass("importe");
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "montoDebe", "servicioTecnico.montoDebe", 20, EntityGrid::TEXT_ALIGN_RIGHT, new GridImporteFormat() );
		$column->setCssClass("importe");
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "estado", "servicioTecnico.estado", 20, EntityGrid::TEXT_ALIGN_LEFT, new GridEstadoVentaFormat() );
		$this->addColumn( $column );
		
		$column = GridModelBuilder::buildColumn( "estadoServicio", "servicioTecnico.estadoServicio", 20, EntityGrid::TEXT_ALIGN_LEFT);
		$this->addColumn( $column );
		
	}

	
	
	
	
	public function getRowStyleClass($item){
		if ($item->getEstadoServicio()) {
			return LpnklfUIUtils::getEstadoServicioCss($item->getEstadoServicio()->getOid());
		}
		
		
	}
	
	public function getDefaultFilterField() {
        return "oid";
    }

	public function getDefaultOrderField(){
		return "oid";
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
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.serviciosTecnico.modificar") );
		$menuOption->setPageName( "ServicioTecnicoModificar" );
		$menuOption->addParam("oid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/editar_32.png" );
		$options[] = $menuOption ;

		if( $item->podesAnularte() ){
			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( "menu.serviciosTecnico.anular") );
			$menuOption->setPageName( "ServicioTecnicoAnular" );
			$menuOption->addParam("servicioTecnicoOid",$item->getOid());
			$menuOption->setIconClass( "icon-anular" );
			$options[] = $menuOption ;
		}
		
		
		if( $item->podesCobrarte() ){
			$menuOption = new MenuOption();
			$menuOption->setLabel( $this->localize( "menu.serviciosTecnico.cobrar") );
			$menuOption->setPageName( "ServicioTecnicoCobrar" );
			$menuOption->addParam("servicioTecnicoOid",$item->getOid());
			$menuOption->setIconClass( "icon-cobrar-venta fg-green" );
			$options[] = $menuOption ;
		}

		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.serviciosTecnico.pdf") );
		$menuOption->setPdf(1);
		$menuOption->setTarget("_blank");
		$menuOption->setPageName( "ServicioTecnicoPDF" );
		$menuOption->addParam("servicioTecnicoOid",$item->getOid());
		$menuOption->setImageSource( $this->getWebPath() . "css/images/pdf_16.png" );
		$options[] = $menuOption ;
		
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "menu.serviciosTecnico.estados") );
		$menuOption->setPageName( "HistoricoEstados" );
		$menuOption->addParam("servicioTecnicoOid",$item->getOid());
		
		$options[] = $menuOption ;
		
		
		$group->setMenuOptions( $options );
		
		return array( $group );
		
	} 
    
}
?>
<?php
namespace Lpnklf\UI\pages\serviciosTecnico;

use Lpnklf\UI\pages\LpnklfPage;

use Lpnklf\UI\components\filter\model\UIServicioTecnicoCriteria;

use Lpnklf\UI\components\grid\model\ServicioTecnicoGridModel;

use Lpnklf\UI\service\UIServicioTecnicoService;

use Lpnklf\UI\service\UIServiceFactory;

use Lpnklf\UI\utils\LpnklfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Lpnklf\Core\model\ServicioTecnico;
use Lpnklf\Core\criteria\ServicioTecnicoCriteria;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;
use Rasty\utils\LinkBuilder;

/**
 * Página para consultar los serviciosTecnico.
 * 
 * @author Marcos
 * @since 08/03/2018
 * 
 */
class ServiciosTecnico extends LpnklfPage{
	private $servicioTecnico;
	private $servicioTecnicoCriteria;
	public function __construct(){
		$servicioTecnicoCriteria = new ServicioTecnicoCriteria();
		
		
		$this->setServicioTecnicoCriteria($servicioTecnicoCriteria);
	}
	
	public function getTitle(){
		return $this->localize( "serviciosTecnico.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "servicioTecnico.agregar") );
		$menuOption->setPageName("ServicioTecnicoAgregar");
		$menuOption->setImageSource( $this->getWebPath() . "css/images/add_over_48.png" );
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "ServiciosTecnico";
		
	}	

	public function getModelClazz(){
		return get_class( new ServicioTecnicoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIServicioTecnicoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		$servicioTecnicoOid = ( $this->getServicioTecnico())?$this->getServicioTecnico()->getOid():'';
		$xtpl->assign( "servicioTecnicoOid", $servicioTecnicoOid );
		$params = array('servicioTecnicoOid'=>$servicioTecnicoOid);
		$xtpl->assign("linkServicioTecnicoPDF",  LinkBuilder::getPdfUrl( "ServicioTecnicoPDF", $params) );
		$xtpl->assign("agregar_label", $this->localize("servicioTecnico.agregar") );
		$productoFilter = $this->getComponentById("serviciosTecnicoFilter");
		//print_r($productoFilter);
		$productoFilter->fillFromSaved( $this->getServicioTecnicoCriteria() );
	}
	
	public function getServicioTecnicoCriteria()
	{
	    return $this->servicioTecnicoCriteria;
	}

	public function setServicioTecnicoCriteria($servicioTecnicoCriteria)
	{
	    $this->servicioTecnicoCriteria = $servicioTecnicoCriteria;
	}
	
	public function setServicioTecnicoOid($servicioTecnicoOid)
	{
		if(!empty($servicioTecnicoOid)){
			$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get($servicioTecnicoOid);
			$this->setServicioTecnico($servicioTecnico);
		}
		
	    
	}


	public function getServicioTecnico()
	{
	    return $this->servicioTecnico;
	}

	public function setServicioTecnico($servicioTecnico)
	{
	    $this->servicioTecnico = $servicioTecnico;
	}
}
?>
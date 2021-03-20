<?php
namespace Lpnklf\UI\pages\historicoEstados;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\service\UIServiceFactory;

use Lpnklf\UI\components\filter\model\UIHistoricoEstadoCriteria;

use Lpnklf\UI\components\grid\model\HistoricoEstadoGridModel;

use Lpnklf\UI\pages\LpnklfPage;

use Lpnklf\UI\utils\LpnklfUtils;

use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;
use Rasty\i18n\Locale;

use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;


/**
 * Página para consultar los movimientos de la cuentaCorriente.
 * 
 * @author Marcos
 * @since 04-04-2018
 * 
 */
class HistoricoEstados extends LpnklfPage{

	private $servicioTecnico;
	
	public function __construct(){
		
		//buscamos la cuenta corriente dado el oid
		$oid = RastyUtils::getParamGET("servicioTecnicoOid");
		$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get( $oid );
		
		$this->setServicioTecnico($servicioTecnico);
		
	}
	
	public function getTitle(){
		return $this->localize( "historicoEstados.title" );
	}

	public function getMenuGroups(){

		//TODO construirlo a partir del usuario 
		//y utilizando permisos
		
		$menuGroup = new MenuGroup();
		
		$menuOption = new MenuOption();
		$menuOption->setLabel( $this->localize( "form.volver") );
		$menuOption->setPageName("ServiciosTecnico");
		$menuGroup->addMenuOption( $menuOption );
		
		
		return array($menuGroup);
	}
	
	public function getType(){
		
		return "HistoricoEstados";
		
	}	

	public function getModelClazz(){
		return get_class( new HistoricoEstadoGridModel() );
	}

	public function getUicriteriaClazz(){
		return get_class( new UIHistoricoEstadoCriteria() );
	}
	
	protected function parseXTemplate(XTemplate $xtpl){

		$xtpl->assign("legend_operaciones", $this->localize("grid.operaciones") );
		$xtpl->assign("legend_resultados", $this->localize("grid.resultados") );
		
		//$xtpl->assign("agregar_label", $this->localize("cliente.agregar") );
	}

	
	
	public function getLegend(){
		
		$nombre = $this->getServicioTecnico();
		
		return LpnklfUIUtils::formatMessage( $this->localize("historicoEstados.buscar"), array($nombre)) ;
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
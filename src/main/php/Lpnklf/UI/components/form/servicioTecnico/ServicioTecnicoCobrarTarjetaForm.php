<?php

namespace Lpnklf\UI\components\form\servicioTecnico;

use Lpnklf\UI\components\filter\model\UITarjetaCriteria;



use Lpnklf\UI\service\finder\TarjetaFinder;



use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\service\UIServiceFactory;


use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;



use Rasty\utils\LinkBuilder;

/**
 * Formulario para cobrar servicio tecnico con tarjeta

 * @author Marcos
 * @since 27/03/2018
 */
class ServicioTecnicoCobrarTarjetaForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var Tarjeta
	 */
	private $tarjeta;
	

	
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("nro");
		$this->addProperty("marca");
		$this->addProperty("titular");
		
		$this->setBackToOnSuccess("ServiciosTecnico");
		$this->setBackToOnCancel("ServicioTecnicoCobrar");
		
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		return "ServicioTecnicoCobrarTarjetaForm";
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		
		
		
	}

	protected function parseXTemplate(XTemplate $xtpl){
		
		$monto = RastyUtils::getParamGET("monto");
		$this->fillInput("monto", $monto );

		parent::parseXTemplate($xtpl);
		
		$servicioTecnicoOid = RastyUtils::getParamGET("servicioTecnicoOid");
		$xtpl->assign("servicioTecnicoOid", $servicioTecnicoOid );
		
		$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get( $servicioTecnicoOid );
		if ($servicioTecnico) {
			$xtpl->assign("clienteOid", $servicioTecnico->getCliente()->getOid() );
		}
		
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_tarjeta", $this->localize("tarjeta.tarjetas") );
		$xtpl->assign("lbl_titular", $this->localize("tarjeta.titular") );
		$xtpl->assign("lbl_marca", $this->localize("tarjeta.marca") );
		$xtpl->assign("lbl_nro", $this->localize("tarjeta.nro") );
		$xtpl->assign("lbl_monto", $this->localize("tarjeta.monto") );
		
		$xtpl->assign("linkSeleccionarTarjeta", $this->getLinkActionSeleccionarTarjeta() );
		
	}

	
	public function getLinkActionSeleccionarTarjeta(){
		
		return LinkBuilder::getActionAjaxUrl( "SeleccionarTarjetaJson") ;
		
	}

	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}


	
	
	
	public function getLinkCancel(){
		//$params = array();
		$servicioTecnicoOid = RastyUtils::getParamGET("servicioTecnicoOid");
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , array("servicioTecnicoOid"=>$servicioTecnicoOid)) ;
	}

	
	
	

	public function getTarjeta()
	{
	    return $this->tarjeta;
	}

	public function setTarjeta($tarjeta)
	{
	    $this->tarjeta = $tarjeta;
	}
	
	public function getTarjetaFinderClazz(){
		
		return get_class( new TarjetaFinder() );
		
	}
	
	public function getTarjetas(){
		$servicioTecnicoOid = RastyUtils::getParamGET("servicioTecnicoOid");
		if (!$servicioTecnicoOid) {
			$servicioTecnicoOid = RastyUtils::getParamPOST("servicioTecnicoOid");
		}
		
		
		$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get( $servicioTecnicoOid );
		$criteria = new UITarjetaCriteria();
		if ($servicioTecnico) {
			$criteria->setCliente($servicioTecnico->getCliente());
		}
		
		$tarjetas = UIServiceFactory::getUITarjetaService()->getList( $criteria );
		
		return $tarjetas;
	}

}
?>
<?php
namespace Lpnklf\UI\pages\serviciosTecnico\cobrar;

use Lpnklf\UI\service\UIServiceFactory;

use Lpnklf\Core\utils\LpnklfUtils;
use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\pages\LpnklfPage;

use Rasty\utils\XTemplate;
use Lpnklf\Core\model\ServicioTecnico;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class ServicioTecnicoCobrar extends LpnklfPage{

	/**
	 * servicioTecnico a cobrar.
	 * @var ServicioTecnico
	 */
	private $servicioTecnico;

	private $error;
	
	public function __construct(){
		
		//inicializamos el servicioTecnico.
		$servicioTecnico = new ServicioTecnico();
		
		
		$this->setServicioTecnico($servicioTecnico);

		
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
	
	public function getTitle(){
		return $this->localize( "servicioTecnico.cobrar.title" );
	}

	public function getType(){
		
		return "ServicioTecnicoCobrar";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		$xtpl->assign( "servicioTecnico_legend", $this->localize( "cobrarServicioTecnico.servicioTecnico.legend") );
		$xtpl->assign( "forma_pago_legend", $this->localize( "cobrarServicioTecnico.forma_pago.legend") );
		
		$xtpl->assign( "lbl_efectivo", $this->localize( "forma.pago.efectivo") );
		$xtpl->assign( "lbl_tarjeta", $this->localize( "forma.pago.tarjeta") );
		$xtpl->assign( "lbl_ctacte", $this->localize( "forma.pago.ctacte") );
		$xtpl->assign( "lbl_anular", $this->localize( "servicioTecnico.anular") );
		
		
		
		$xtpl->assign( "linkCobrarEfectivo", $this->getLinkActionCobrarServicioTecnicoEfectivo($this->getServicioTecnico()) );
		$xtpl->parse( "main.forma_pago_caja");
		
		$xtpl->assign( "linkCobrarTarjeta", $this->getLinkCobrarServicioTecnicoTarjeta($this->getServicioTecnico()) );
		$xtpl->parse( "main.forma_pago_tarjeta");
		
		$xtpl->assign( "linkAnular", $this->getLinkServicioTecnicoAnular( $this->getServicioTecnico()) );
		
		if( $this->getServicioTecnico()->getCliente()->hasCuentaCorriente() ){
			$xtpl->assign( "linkCobrarCtaCte", $this->getLinkActionCobrarServicioTecnicoCtaCte($this->getServicioTecnico()) );
			$xtpl->parse( "main.forma_pago_ctacte");
		}
		
		$msg = $this->getError();
		
		if( !empty($msg) ){
			
			$xtpl->assign("msg", $msg);
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
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
	
	public function setServicioTecnicoOid($servicioTecnicoOid)
	{
		if(!empty($servicioTecnicoOid)){
			$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get($servicioTecnicoOid);
			$this->setServicioTecnico($servicioTecnico);
		}
		
	    
	}
					
	public function getMsgError(){
		return "";
	}

	public function getError()
	{
	    return $this->error;
	}

	public function setError($error)
	{
	    $this->error = $error;
	}
}
?>
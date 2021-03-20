<?php
namespace Lpnklf\UI\pages\serviciosTecnico\anular;

use Lpnklf\UI\service\UIServiceFactory;

use Lpnklf\Core\utils\LpnklfUtils;
use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\pages\LpnklfPage;

use Rasty\utils\XTemplate;
use Lpnklf\Core\model\ServicioTecnico;
use Rasty\Menu\menu\model\MenuGroup;
use Rasty\Menu\menu\model\MenuOption;

class ServicioTecnicoAnular extends LpnklfPage{

	/**
	 * servicioTecnico a anular.
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
		
//		$menuOption = new MenuOption();
//		$menuOption->setLabel( $this->localize( "form.volver") );
//		$menuOption->setPageName("ServicioTecnicos");
//		$menuGroup->addMenuOption( $menuOption );
//		
		
		return array($menuGroup);
	}
	
	public function getTitle(){
		return $this->localize( "servicioTecnico.anular.title" );
	}

	public function getType(){
		
		return "ServicioTecnicoAnular";
		
	}	

	protected function parseXTemplate(XTemplate $xtpl){
		
		$xtpl->assign( "servicioTecnico_legend", $this->localize( "anularServicioTecnico.servicioTecnico.legend") );
		
		$xtpl->assign( "servicioTecnicoOid", $this->getServicioTecnico()->getOid() );
		
		$xtpl->assign( "linkAnularServicioTecnico", $this->getLinkActionAnularServicioTecnico($this->getServicioTecnico()) );
		
		$msg = $this->getError();
		
		if( !empty($msg) ){
			
			$xtpl->assign("msg", $msg);
			//$xtpl->assign("msg",  );
			$xtpl->parse("main.msg_error" );
		}
		
		$xtpl->assign( "lbl_submit", $this->localize("anularServicioTecnico.confirm") );
		$xtpl->assign( "lbl_cancel", $this->localize("anularServicioTecnico.cancel") );
		
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
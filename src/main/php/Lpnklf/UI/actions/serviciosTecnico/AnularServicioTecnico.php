<?php
namespace Lpnklf\UI\actions\serviciosTecnico;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\service\UIServiceFactory;
use Lpnklf\Core\model\ServicioTecnico;
use Lpnklf\Core\utils\LpnklfUtils;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se anula una servicioTecnico
 * 
 * @author Marcos
 * @since 05/04/2018
 */
class AnularServicioTecnico extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		
		//tomamos la servicioTecnico
		$servicioTecnicoOid = RastyUtils::getParamPOST("servicioTecnicoOid");
		$forward->addParam( "servicioTecnicoOid", $servicioTecnicoOid );
		try {

			//la recuperamos la servicioTecnico.
			$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get( $servicioTecnicoOid );
			
			$user = RastySecurityContext::getUser();
			$user = LpnklfUtils::getUserByUsername($user->getUsername());
			
			UIServiceFactory::getUIServicioTecnicoService()->anular($servicioTecnico, $user);			
			
			$forward->setPageName( "AdminHome" );
		
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "ServicioTecnicoAnular" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
		}
		
		return $forward;
		
	}

}
?>
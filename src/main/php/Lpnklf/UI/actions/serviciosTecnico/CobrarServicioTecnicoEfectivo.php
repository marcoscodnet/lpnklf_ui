<?php
namespace Lpnklf\UI\actions\serviciosTecnico;

use Lpnklf\UI\utils\LpnklfUIUtils;
use Lpnklf\Core\utils\LpnklfUtils;

use Lpnklf\UI\service\UIServiceFactory;
use Lpnklf\Core\model\ServicioTecnico;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se cobra una servicioTecnico en efectivo
 * 
 * @author Marcos
 * @since 05/04/2018
 */
class CobrarServicioTecnicoEfectivo extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		
		//tomamos la servicioTecnico
		$servicioTecnicoOid = RastyUtils::getParamGET("servicioTecnicoOid");
		$forward->addParam( "servicioTecnicoOid", $servicioTecnicoOid );
		try {

			
			//la recuperamos la servicioTecnico.
			$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get( $servicioTecnicoOid );
			$monto = RastyUtils::getParamGET("monto");
			//$servicioTecnico->setMonto($monto);

			$cuenta = LpnklfUtils::getCuentaUnica();
			
			
			$user = RastySecurityContext::getUser();
			$user = LpnklfUtils::getUserByUsername($user->getUsername());
			
			UIServiceFactory::getUIServicioTecnicoService()->cobrar($servicioTecnico, $cuenta, $user, $monto);			
			
			$forward->setPageName( "AdminHome" );
		
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "ServicioTecnicoCobrar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
		}
		
		return $forward;
		
	}

}
?>
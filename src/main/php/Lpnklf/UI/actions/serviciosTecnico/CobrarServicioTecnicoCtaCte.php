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
 * se cobra una servicioTecnico con la cuenta corriente del cliente
 * 
 * @author Marcos
 * @since 05-04-2018
 */
class CobrarServicioTecnicoCtaCte extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		
		//tomamos la servicioTecnico
		$servicioTecnicoOid = RastyUtils::getParamGET("servicioTecnicoOid");
		$forward->addParam( "servicioTecnicoOid", $servicioTecnicoOid );
		try {

			
			//recuperamos la servicioTecnico.
			$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get( $servicioTecnicoOid );
			$monto = RastyUtils::getParamGET("monto");
			//tomamos la caja del contexto, para saber que la servicioTecnico se hizo desde esta caja.
			//$caja = LpnklfUtils::getCajaDeafault();
				
			//el usuario
			$user = RastySecurityContext::getUser();
			$user = LpnklfUtils::getUserByUsername($user->getUsername());
			
			//cobramos en cuenta corriente.
			UIServiceFactory::getUIServicioTecnicoService()->cobrarCtaCte($servicioTecnico, $user, $monto);			
			
			$forward->setPageName( "AdminHome" );
		
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "ServicioTecnicoCobrar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
		}
		
		return $forward;
		
	}

}
?>
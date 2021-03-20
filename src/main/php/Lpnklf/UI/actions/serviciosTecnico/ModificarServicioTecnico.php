<?php
namespace Lpnklf\UI\actions\serviciosTecnico;

use Lpnklf\UI\components\form\servicioTecnico\ServicioTecnicoForm;

use Lpnklf\UI\service\UIServiceFactory;
use Lpnklf\UI\utils\LpnklfUtils;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\factory\ComponentConfig;
use Rasty\factory\ComponentFactory;

use Rasty\i18n\Locale;

use Rasty\factory\PageFactory;

/**
 * se realiza la actualización de un servicioTecnico.
 * 
 * @author Marcos
 * @since 08/03/2018
 */
class ModificarServicioTecnico extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("ServicioTecnicoModificar");
		
		$servicioTecnicoForm = $page->getComponentById("servicioTecnicoForm");
			
		$oid = $servicioTecnicoForm->getOid();
						
		try {

			//obtenemos el servicioTecnico.
			$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$servicioTecnicoForm->fillEntity($servicioTecnico);
			
			//guardamos los cambios.
			UIServiceFactory::getUIServicioTecnicoService()->update( $servicioTecnico );
			
			$forward->setPageName( $servicioTecnicoForm->getBackToOnSuccess() );
			$forward->addParam( "servicioTecnicoOid", $servicioTecnico->getOid() );
			
			$servicioTecnicoForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "ServicioTecnicoModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$servicioTecnicoForm->save();
			
		}
		return $forward;
		
	}

}
?>
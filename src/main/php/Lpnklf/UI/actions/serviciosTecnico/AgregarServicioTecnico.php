<?php
namespace Lpnklf\UI\actions\serviciosTecnico;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\components\form\servicioTecnico\ServicioTecnicoForm;

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
 * se realiza el alta de un servicioTecnico.
 * 
 * @author Marcos
 * @since 08/03/2018
 */
class AgregarServicioTecnico extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("ServicioTecnicoAgregar");
		
		$servicioTecnicoForm = $page->getComponentById("servicioTecnicoForm");
		
		try {

			//creamos un nuevo servicioTecnico.
			$servicioTecnico = new ServicioTecnico();
			
			//completados con los datos del formulario.
			$servicioTecnicoForm->fillEntity($servicioTecnico);
			
			//agregamos el servicioTecnico.
			UIServiceFactory::getUIServicioTecnicoService()->add( $servicioTecnico );
			
			$forward->setPageName( $servicioTecnicoForm->getBackToOnSuccess() );
			$forward->addParam( "servicioTecnicoOid", $servicioTecnico->getOid() );			
		
			$servicioTecnicoForm->cleanSavedProperties();
			
		} catch (RastyDuplicatedException $e) {
		
			$forward->setPageName( "ServicioTecnicoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
						
			//guardamos lo ingresado en el form.
			$servicioTecnicoForm->save();
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "ServicioTecnicoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
						
			//guardamos lo ingresado en el form.
			$servicioTecnicoForm->save();
		}
		
		return $forward;
		
	}

}
?>
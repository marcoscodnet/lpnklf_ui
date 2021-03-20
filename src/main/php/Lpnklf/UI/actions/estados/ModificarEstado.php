<?php
namespace Lpnklf\UI\actions\estados;

use Lpnklf\UI\components\form\estado\EstadoForm;

use Lpnklf\UI\service\UIServiceFactory;

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
 * se realiza la actualización de una estado.
 * 
 * @author Marcos
 * @since 05/03/2018
 */
class ModificarEstado extends Action{

	
	public function execute(){

		$forward = new Forward();
		
		$page = PageFactory::build("EstadoModificar");
		
		$estadoForm = $page->getComponentById("estadoForm");
			
		$oid = $estadoForm->getOid();
						
		try {

			//obtenemos la estado.
			$estado = UIServiceFactory::getUIEstadoService()->get($oid );
		
			//lo editamos con los datos del formulario.
			$estadoForm->fillEntity($estado);
			
			//guardamos los cambios.
			UIServiceFactory::getUIEstadoService()->update( $estado );
			
			$forward->setPageName( $estadoForm->getBackToOnSuccess() );
			$forward->addParam( "estadoOid", $estado->getOid() );
			
			$estadoForm->cleanSavedProperties();
			
		} catch (RastyException $e) {
		
			$forward->setPageName( "EstadoModificar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			$forward->addParam("oid", $oid );
			
			//guardamos lo ingresado en el form.
			$estadoForm->save();
			
		}
		return $forward;
		
	}

}
?>
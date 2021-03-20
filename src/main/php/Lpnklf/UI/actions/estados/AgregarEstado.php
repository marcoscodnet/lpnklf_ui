<?php
namespace Lpnklf\UI\actions\estados;


use Lpnklf\UI\components\form\estado\EstadoForm;

use Lpnklf\UI\service\UIServiceFactory;
use Lpnklf\Core\model\Estado;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se realiza el alta de una Estado.
 * 
 * @author Marcos
 * @since 07/03/2018
 */
class AgregarEstado extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("EstadoAgregar");
		
		$estadoForm = $page->getComponentById("estadoForm");
		
		try {

			//creamos una nueva estado.
			$estado = new Estado();
			
			//completados con los datos del formulario.
			$estadoForm->fillEntity($estado);
			
			//agregamos el estado.
			UIServiceFactory::getUIEstadoService()->add( $estado );
			
			$forward->setPageName( $estadoForm->getBackToOnSuccess() );
			$forward->addParam( "estadoOid", $estado->getOid() );			
		
			$estadoForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "EstadoAgregar" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$estadoForm->save();
		}
		
		return $forward;
		
	}

}
?>
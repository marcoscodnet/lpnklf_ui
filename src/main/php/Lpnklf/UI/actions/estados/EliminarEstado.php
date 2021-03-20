<?php
namespace Lpnklf\UI\actions\estados;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\service\UIServiceFactory;
use Lpnklf\Core\model\Estado;
use Lpnklf\Core\utils\LpnklfUtils;

use Rasty\actions\JsonAction;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;


/**
 * se eliminar un tipo de documento
 * 
 * @author Marcos
 * @since 07/03/2018
 */
class EliminarEstado extends JsonAction{

	
	public function execute(){

		try {

			$estadoOid = RastyUtils::getParamGET("estadoOid");
			
			//obtenemos la estado
			$estado = UIServiceFactory::getUIEstadoService()->get($estadoOid);

			UIServiceFactory::getUIEstadoService()->delete($estado);
			
			$result["info"] = Locale::localize("estado.borrar.success")  ;
			
		} catch (RastyException $e) {
		
			$result["error"] = Locale::localize($e->getMessage())  ;
			
		}
		
		return $result;		
		
	}
}
?>
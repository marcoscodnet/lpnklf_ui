<?php
namespace Lpnklf\UI\actions\productos;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\service\UIServiceFactory;
use Lpnklf\Core\model\Producto;
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
 * @since 06/03/2018
 */
class EliminarProducto extends JsonAction{

	
	public function execute(){

		try {

			$productoOid = RastyUtils::getParamGET("productoOid");
			
			//obtenemos la producto
			$producto = UIServiceFactory::getUIProductoService()->get($productoOid);

			UIServiceFactory::getUIProductoService()->delete($producto);
			
			$result["info"] = Locale::localize("producto.borrar.success")  ;
			
		} catch (RastyException $e) {
		
			$result["error"] = Locale::localize($e->getMessage())  ;
			
		}
		
		return $result;		
		
	}
}
?>
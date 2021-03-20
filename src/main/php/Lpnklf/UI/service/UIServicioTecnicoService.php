<?php
namespace Lpnklf\UI\service;

use Lpnklf\UI\components\filter\model\UIServicioTecnicoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Lpnklf\Core\model\ServicioTecnico;
use Lpnklf\Core\model\Cuenta;
use Lpnklf\Core\model\Caja;

use Lpnklf\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para serviciosTecnico.
 * 
 * @author Marcos
 * @since 08/03/2018
 */
class UIServicioTecnicoService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIServicioTecnicoService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIServicioTecnicoCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getServicioTecnicoService();
			
			$serviciosTecnico = $service->getList( $criteria );
	
			return $serviciosTecnico;
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{	

			$service = ServiceFactory::getServicioTecnicoService();
		
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	

	public function add( ServicioTecnico $servicioTecnico ){

		try{

			$service = ServiceFactory::getServicioTecnicoService();
		
			return $service->add( $servicioTecnico );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( ServicioTecnico $servicioTecnico ){

		try{

			$service = ServiceFactory::getServicioTecnicoService();
		
			return $service->update( $servicioTecnico );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getServicioTecnicoService();
			$serviciosTecnico = $service->getCount( $criteria );
			
			return $serviciosTecnico;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
	public function delete(ServicioTecnico $servicioTecnico){

		try {
			
			$service = ServiceFactory::getServicioTecnicoService();
			
			return $service->delete($servicioTecnico->getOid());

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}
	
	public function cobrar(ServicioTecnico $servicioTecnico, Cuenta $cuenta, User $user, $monto){

		try {
			
			$service = ServiceFactory::getServicioTecnicoService();
			
			return $service->cobrar($servicioTecnico, $cuenta, $user, $monto);

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}

	
	public function anular(ServicioTecnico $servicioTecnico, User $user){

		try {
			
			$service = ServiceFactory::getServicioTecnicoService();
			
			return $service->anular($servicioTecnico, $user);

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}

	public function cobrarCtaCte(ServicioTecnico $servicioTecnico, User $user, $monto){

		try {
			
			$service = ServiceFactory::getServicioTecnicoService();
			
			return $service->cobrarCtaCte($servicioTecnico, $user, $monto);

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}
}
?>
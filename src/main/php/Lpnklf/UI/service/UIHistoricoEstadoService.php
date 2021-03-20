<?php
namespace Lpnklf\UI\service;

use Lpnklf\UI\components\filter\model\UIHistoricoEstadoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Lpnklf\Core\model\HistoricoEstado;

use Lpnklf\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para historicoEstados.
 * 
 * @author Marcos
 * @since 04/04/2018
 */
class UIHistoricoEstadoService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIHistoricoEstadoService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIHistoricoEstadoCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getHistoricoEstadoService();
			
			$historicoEstados = $service->getList( $criteria );
	
			return $historicoEstados;
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{	

			$service = ServiceFactory::getHistoricoEstadoService();
		
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	

	public function add( HistoricoEstado $tipoProducto ){

		try{

			$service = ServiceFactory::getHistoricoEstadoService();
		
			return $service->add( $tipoProducto );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( HistoricoEstado $tipoProducto ){

		try{

			$service = ServiceFactory::getHistoricoEstadoService();
		
			return $service->update( $tipoProducto );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getHistoricoEstadoService();
			$historicoEstados = $service->getCount( $criteria );
			
			return $historicoEstados;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
	
	public function delete(HistoricoEstado $tipoProducto){

		try {
			
			$service = ServiceFactory::getHistoricoEstadoService();
			
			return $service->delete($tipoProducto->getOid());

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}
}
?>
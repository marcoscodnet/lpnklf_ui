<?php
namespace Lpnklf\UI\service;

use Lpnklf\UI\components\filter\model\UIMovimientoCajaCriteria;
use Lpnklf\UI\components\filter\model\UITarjetaCriteria;
use Lpnklf\UI\components\filter\model\UICuentaCorrienteCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Lpnklf\Core\model\Caja;

use Lpnklf\Core\service\ServiceFactory;
use Lpnklf\Core\utils\LpnklfUtils;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para movimientos de Caja.
 * 
 * @author Marcos
 * @since 13/03/2018
 */
class UIMovimientoCajaService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIMovimientoCajaService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIMovimientoCajaCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getMovimientoCajaService();
			
			$movimientos = $service->getList( $criteria );
	
			return $movimientos;
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{	

			$service = ServiceFactory::getMovimientoCajaService();
		
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	

	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getMovimientoCajaService();
			$movimientos = $service->getCount( $criteria );
			
			return $movimientos;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
	public function getTotalesDia( \Datetime $fecha ){
		
		try {
			
			$service = ServiceFactory::getMovimientoCajaService();
			
			return $service->getTotales(LpnklfUtils::getCuentaUnica(), $fecha );

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
				
	}
	
	public function getTotalesTarjetasDia( \Datetime $fecha ){
		
		try {
			$tarjetas = UIServiceFactory::getUITarjetaService()->getList( new UITarjetaCriteria() );
			$arrayTarjetas = array();
			foreach ($tarjetas as $tarjeta) {
				$arrayTarjetas[] = $tarjeta->getOid();;
			}
			$service = ServiceFactory::getMovimientoCajaService();
			
			return $service->getTotalesTarjetas($arrayTarjetas, $fecha );

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
				
	}
	
	public function getTotalesCtasCtesDia( \Datetime $fecha ){
		
		try {
			$ctasctes = UIServiceFactory::getUICuentaCorrienteService()->getList( new UICuentaCorrienteCriteria() );
			$arrayCtasctes = array();
			foreach ($ctasctes as $ctacte) {
				$arrayCtasctes[] = $ctacte->getOid();;
			}
			$service = ServiceFactory::getMovimientoCajaService();
			
			return $service->getTotalesTarjetas($arrayCtasctes, $fecha );

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
				
	}
	
	
}
?>
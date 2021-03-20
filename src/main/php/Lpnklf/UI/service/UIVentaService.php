<?php
namespace Lpnklf\UI\service;

use Lpnklf\UI\components\filter\model\UIVentaCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Lpnklf\Core\model\Venta;
use Lpnklf\Core\model\Cuenta;
use Lpnklf\Core\model\Caja;

use Lpnklf\Core\service\ServiceFactory;
use Cose\Security\model\User;

use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para Venta.
 * 
 * @author Marcos
 * @since 13/03/2018
 */
class UIVentaService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIVentaService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIVentaCriteria $uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getVentaService();
			
			$ventas = $service->getList( $criteria );
	
			return $ventas;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	public function get( $oid ){

		try{
			
			$service = ServiceFactory::getVentaService();
		
			return $service->get( $oid );
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function add( Venta $venta ){

		try {
			
			$service = ServiceFactory::getVentaService();
			
			return $service->add( $venta );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}


	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getVentaService();
			$ventas = $service->getCount( $criteria );
			
			return $ventas;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
	
	public function cobrar(Venta $venta, Cuenta $cuenta, User $user, $monto){

		try {
			
			$service = ServiceFactory::getVentaService();
			
			return $service->cobrar($venta, $cuenta, $user, $monto);

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}

	
	public function anular(Venta $venta, User $user){

		try {
			
			$service = ServiceFactory::getVentaService();
			
			return $service->anular($venta, $user);

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}

	public function cobrarCtaCte(Venta $venta, User $user, $monto){

		try {
			
			$service = ServiceFactory::getVentaService();
			
			return $service->cobrarCtaCte($venta, $user, $monto);

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}

	public function getTotalesDia( \Datetime $fecha ){
		
		try {
			
			$service = ServiceFactory::getVentaService();
			
			return $service->getTotalesDia( $fecha );

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
				
	}
	
	public function getTotalesMes( \Datetime $fecha ){
		
		
		try {
			
			$service = ServiceFactory::getVentaService();
			
			return $service->getTotalesMes( $fecha );

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
				
	}


	public function getTotalesCajaVentasOnlineCtaCte( Caja $caja ){

		try {
			
			$service = ServiceFactory::getMovimientoVentaService();
			
			$totales = $service->getTotalesCajaVentasOnlineCtaCte( $caja );

			return $totales;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	
	public function getTotalesCuenta( Cuenta $cuenta=null, \DateTime $fecha=null ){

		try {
			
			$service = ServiceFactory::getMovimientoVentaService();
			
			$totales = $service->getTotales( $cuenta, $fecha );

			return $totales;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function getTotalesCuentaMes( Cuenta $cuenta=null, \DateTime $fecha=null ){

		try {
			
			$service = ServiceFactory::getMovimientoVentaService();
			
			$totales = $service->getTotalesMes( $cuenta, $fecha );

			return $totales;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function getTotalesCuentaAnioPorMes( Cuenta $cuenta=null, $anio ){

		try {
			
			$service = ServiceFactory::getMovimientoVentaService();
			
			$totales = $service->getTotalesAnioPorMes( $cuenta, $anio );

			return $totales;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function getTotalesCuentaPorCategoria( Cuenta $cuenta=null, \DateTime $fecha=null ){

		try {
			
			$service = ServiceFactory::getMovimientoVentaService();
			
			$totales = $service->getTotalesPorCategoria( $cuenta, $fecha );

			return $totales;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
}
?>
<?php
namespace Lpnklf\UI\service;

use Lpnklf\UI\components\filter\model\UIProductoCriteria;

use Rasty\components\RastyPage;
use Rasty\utils\XTemplate;
use Rasty\i18n\Locale;
use Rasty\exception\RastyException;
use Cose\criteria\impl\Criteria;

use Lpnklf\Core\model\Producto;

use Lpnklf\Core\service\ServiceFactory;
use Cose\Security\model\User;
use Rasty\Grid\entitygrid\model\IEntityGridService;
use Rasty\Grid\filter\model\UICriteria;

/**
 * 
 * UI service para productos.
 * 
 * @author Marcos
 * @since 06/03/2018
 */
class UIProductoService  implements IEntityGridService{
	
	private static $instance;
	
	private function __construct() {}
	
	public static function getInstance() {
		
		if( self::$instance == null ) {
			
			self::$instance = new UIProductoService();
			
		}
		return self::$instance; 
	}

	
	
	public function getList( UIProductoCriteria $uiCriteria){

		try{
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getProductoService();
			
			$productos = $service->getList( $criteria );
	
			return $productos;
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	public function get( $oid ){

		try{	

			$service = ServiceFactory::getProductoService();
		
			return $service->get( $oid );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	

	public function add( Producto $producto ){

		try{

			$service = ServiceFactory::getProductoService();
		
			return $service->add( $producto );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	public function update( Producto $producto ){

		try{

			$service = ServiceFactory::getProductoService();
		
			return $service->update( $producto );

		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}			

	}
	
	function getEntitiesCount($uiCriteria){

		try{
			
			$criteria = $uiCriteria->buildCoreCriteria() ;
			
			$service = ServiceFactory::getProductoService();
			$productos = $service->getCount( $criteria );
			
			return $productos;
			
		} catch (\Exception $e) {
			
			throw new RastyException($e->getMessage());
			
		}
	}
	
	function getEntities($uiCriteria){
		
		return $this->getList($uiCriteria);
	}
	
	public function delete(Producto $producto){

		try {
			
			$service = ServiceFactory::getProductoService();
			
			return $service->delete($producto->getOid());

		} catch (\Exception $e) {
			
			throw new RastyException( $e->getMessage() );
			
		}
		
	}
	
	function getMasVendidos(){
		
		return $this->getList( new UIProductoCriteria() );
		
	}
	
	function updateStock ( $productosOid, $cantidades, $precios ){
		
		Logger::log("updateStock");
		
		for ($i = 0; $i < count($productosOid); $i++) {

			$cantidad = $cantidades[$i];
			$productoOid = $productosOid[$i];
			$precioCompra = $precios[$i];
			
			Logger::log("cantidad $cantidad producto $productoOid");
			
			$producto = $this->get( $productoOid );
			
			$producto->updateStock( $cantidad, $sucursal );
			$producto->setPrecioCompra($precioCompra);
			$this->update($producto);
			
		}
	}
}
?>
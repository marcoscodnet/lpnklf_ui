<?php
namespace Lpnklf\UI\components\filter\model;


use Lpnklf\UI\components\filter\model\UILpnklfCriteria;

use Rasty\utils\RastyUtils;
use Lpnklf\Core\criteria\MarcaProductoCriteria;

/**
 * Representa un criterio de búsqueda
 * para marcasProducto.
 * 
 * @author Marcos
 * @since 05/03/2018
 *
 */
class UIMarcaProductoCriteria extends UILpnklfCriteria{


	private $nombre;
	
	
	public function __construct(){

		parent::__construct();

	}
		
	public function getNombre()
	{
	    return $this->nombre;
	}

	public function setNombre($nombre)
	{
	    $this->nombre = $nombre;
	}

	
	protected function newCoreCriteria(){
		return new MarcaProductoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setNombre( $this->getNombre() );
		
		return $criteria;
	}

}
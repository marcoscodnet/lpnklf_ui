<?php
namespace Lpnklf\UI\components\filter\model;


use Lpnklf\UI\components\filter\model\UILpnklfCriteria;

use Rasty\utils\RastyUtils;
use Lpnklf\Core\criteria\ParametroCriteria;

/**
 * Representa un criterio de búsqueda
 * para parametros.
 * 
 * @author Marcos
 * @since 16/07/2018
 *
 */
class UIParametroCriteria extends UILpnklfCriteria{


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
		return new ParametroCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setNombre( $this->getNombre() );
		
		return $criteria;
	}

}
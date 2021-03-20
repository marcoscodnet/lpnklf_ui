<?php
namespace Lpnklf\UI\components\filter\model;


use Lpnklf\UI\components\filter\model\UILpnklfCriteria;

use Rasty\utils\RastyUtils;
use Lpnklf\Core\criteria\TipoDispositivoCriteria;

/**
 * Representa un criterio de búsqueda
 * para tiposDispositivo.
 * 
 * @author Marcos
 * @since 07/03/2018
 *
 */
class UITipoDispositivoCriteria extends UILpnklfCriteria{


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
		return new TipoDispositivoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setNombre( $this->getNombre() );
		
		return $criteria;
	}

}
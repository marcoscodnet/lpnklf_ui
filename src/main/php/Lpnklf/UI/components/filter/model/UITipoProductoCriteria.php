<?php
namespace Lpnklf\UI\components\filter\model;


use Lpnklf\UI\components\filter\model\UILpnklfCriteria;

use Rasty\utils\RastyUtils;
use Lpnklf\Core\criteria\TipoProductoCriteria;

/**
 * Representa un criterio de búsqueda
 * para tiposProducto.
 * 
 * @author Marcos
 * @since 05/03/2018
 *
 */
class UITipoProductoCriteria extends UILpnklfCriteria{


	private $nombre;
	private $servicioTecnico;
	
	
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
		return new TipoProductoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setNombre( $this->getNombre() );
		$criteria->setServicioTecnico( $this->getServicioTecnico() );
		
		return $criteria;
	}


	public function getServicioTecnico()
	{
	    return $this->servicioTecnico;
	}

	public function setServicioTecnico($servicioTecnico)
	{
	    $this->servicioTecnico = $servicioTecnico;
	}
}
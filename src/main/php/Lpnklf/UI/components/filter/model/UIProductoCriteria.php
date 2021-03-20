<?php
namespace Lpnklf\UI\components\filter\model;


use Lpnklf\UI\components\filter\model\UILpnklfCriteria;

use Rasty\utils\RastyUtils;
use Lpnklf\Core\criteria\ProductoCriteria;

/**
 * Representa un criterio de búsqueda
 * para productos.
 * 
 * @author Marcos
 * @since 06/03/2018
 *
 */
class UIProductoCriteria extends UILpnklfCriteria{


	private $nombre;
	private $tipoProducto;
	private $marcaProducto;
	private $nombreOTipoOMarca;
	
	
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
		return new ProductoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setNombre( $this->getNombre() );
		$criteria->setTipoProducto( $this->getTipoProducto() );
		$criteria->setMarcaProducto( $this->getMarcaProducto() );
		$criteria->setNombreOTipoOMarca( $this->getNombreOTipoOMarca() );
		
		return $criteria;
	}


	

	public function getTipoProducto()
	{
	    return $this->tipoProducto;
	}

	public function setTipoProducto($tipoProducto)
	{
	    $this->tipoProducto = $tipoProducto;
	}

	public function getMarcaProducto()
	{
	    return $this->marcaProducto;
	}

	public function setMarcaProducto($marcaProducto)
	{
	    $this->marcaProducto = $marcaProducto;
	}

	public function getNombreOTipoOMarca()
	{
	    return $this->nombreOTipoOMarca;
	}

	public function setNombreOTipoOMarca($nombreOTipoOMarca)
	{
	    $this->nombreOTipoOMarca = $nombreOTipoOMarca;
	}
}
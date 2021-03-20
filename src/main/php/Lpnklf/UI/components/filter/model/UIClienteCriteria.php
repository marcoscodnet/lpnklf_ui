<?php
namespace Lpnklf\UI\components\filter\model;


use Lpnklf\UI\components\filter\model\UILpnklfCriteria;

use Rasty\utils\RastyUtils;
use Lpnklf\Core\criteria\ClienteCriteria;

/**
 * Representa un criterio de búsqueda
 * para clientes.
 * 
 * @author Marcos
 * @since 02/03/2018
 *
 */
class UIClienteCriteria extends UILpnklfCriteria{


	private $nombre;
	private $documento;
	
	
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
		return new ClienteCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setNombre( $this->getNombre() );
		$criteria->setDocumento( $this->getDocumento() );
		
		return $criteria;
	}


	public function getDocumento()
	{
	    return $this->documento;
	}

	public function setDocumento($documento)
	{
	    $this->documento = $documento;
	}
}
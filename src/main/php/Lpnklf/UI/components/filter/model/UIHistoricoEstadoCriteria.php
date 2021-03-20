<?php
namespace Lpnklf\UI\components\filter\model;


use Lpnklf\UI\components\filter\model\UILpnklfCriteria;

use Rasty\utils\RastyUtils;
use Lpnklf\Core\criteria\HistoricoEstadoCriteria;

/**
 * Representa un criterio de búsqueda
 * para productos.
 * 
 * @author Marcos
 * @since 06/03/2018
 *
 */
class UIHistoricoEstadoCriteria extends UILpnklfCriteria{


	private $servicioTecnico;
	private $fechaDesde;
	private $fechaHasta;
	private $fechaDesdeDesde;
	private $fechaDesdeHasta;
	private $fechaHastaDesde;
	private $fechaHastaHasta;
	private $estado;
	
	
	public function __construct(){

		parent::__construct();

	}
		
	
	
	protected function newCoreCriteria(){
		return new HistoricoEstadoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
				
		$criteria->setServicioTecnico( $this->getServicioTecnico() );
		$criteria->setFechaDesde( $this->getFechaDesde() );
		$criteria->setFechaHasta( $this->getFechaHasta() );
		$criteria->setFechaDesdeDesde( $this->getFechaDesdeDesde() );
		$criteria->setFechaDesdeHasta( $this->getFechaDesdeHasta() );
		$criteria->setFechaHastaDesde( $this->getFechaHastaDesde() );
		$criteria->setFechaHastaHasta( $this->getFechaHastaHasta() );
		$criteria->setEstado( $this->getEstado() );
		
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

	public function getFechaDesde()
	{
	    return $this->fechaDesde;
	}

	public function setFechaDesde($fechaDesde)
	{
	    $this->fechaDesde = $fechaDesde;
	}

	public function getFechaHasta()
	{
	    return $this->fechaHasta;
	}

	public function setFechaHasta($fechaHasta)
	{
	    $this->fechaHasta = $fechaHasta;
	}

	public function getFechaDesdeDesde()
	{
	    return $this->fechaDesdeDesde;
	}

	public function setFechaDesdeDesde($fechaDesdeDesde)
	{
	    $this->fechaDesdeDesde = $fechaDesdeDesde;
	}

	public function getFechaDesdeHasta()
	{
	    return $this->fechaDesdeHasta;
	}

	public function setFechaDesdeHasta($fechaDesdeHasta)
	{
	    $this->fechaDesdeHasta = $fechaDesdeHasta;
	}

	public function getFechaHastaDesde()
	{
	    return $this->fechaHastaDesde;
	}

	public function setFechaHastaDesde($fechaHastaDesde)
	{
	    $this->fechaHastaDesde = $fechaHastaDesde;
	}

	public function getFechaHastaHasta()
	{
	    return $this->fechaHastaHasta;
	}

	public function setFechaHastaHasta($fechaHastaHasta)
	{
	    $this->fechaHastaHasta = $fechaHastaHasta;
	}

	public function getEstado()
	{
	    return $this->estado;
	}

	public function setEstado($estado)
	{
	    $this->estado = $estado;
	}
}
<?php
namespace Lpnklf\UI\components\filter\model;

use Lpnklf\UI\utils\LpnklfUIUtils;
use Lpnklf\Core\utils\LpnklfUtils;
use Lpnklf\Core\model\EstadoVenta;

use Lpnklf\UI\components\filter\model\UILpnklfCriteria;

use Rasty\utils\RastyUtils;
use Lpnklf\Core\criteria\ServicioTecnicoCriteria;

/**
 * Representa un criterio de búsqueda
 * para serviciosTecnico.
 * 
 * @author Marcos
 * @since 08/03/2018
 *
 */
class UIServicioTecnicoCriteria extends UILpnklfCriteria{

	const HOY = "ventasHoy";
	const SEMANA_ACTUAL = "ventasSemanaActual";
	const MES_ACTUAL = "ventasMesActual";
	const ANIO_ACTUAL = "ventasAnioActual";
	const IMPAGAS = "ventasImpagas";
	const ANULADAS = "ventasAnuladas";
	
	private $fecha;
	private $fechaDesde;
	private $fechaHasta;
	private $cliente;
	private $estado;
	
	private $estados;
	
	private $estadoNotEqual;
	
	
	public function __construct(){

		parent::__construct();
		
		//$this->setFiltroPredefinido( self::HOY );

	}
		
	

	
	protected function newCoreCriteria(){
		return new ServicioTecnicoCriteria();
	}
	
	public function buildCoreCriteria(){
		
		$criteria = parent::buildCoreCriteria();
		$criteria->setFecha( $this->getFecha() );		
		$criteria->setFechaDesde( $this->getFechaDesde() );
		$criteria->setFechaHasta( $this->getFechaHasta() );
		$criteria->setCliente( $this->getCliente() );
		$criteria->setEstado( $this->getEstado() );
		$criteria->setEstados( $this->getEstados() );
		
		return $criteria;
	}

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
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

	public function getCliente()
	{
	    return $this->cliente;
	}

	public function setCliente($cliente)
	{
	    $this->cliente = $cliente;
	}

	public function getEstado()
	{
	    return $this->estado;
	}

	public function setEstado($estado)
	{
	    $this->estado = $estado;
	}

	public function getEstados()
	{
	    return $this->estados;
	}

	public function setEstados($estados)
	{
	    $this->estados = $estados;
	}

	public function getEstadoNotEqual()
	{
	    return $this->estadoNotEqual;
	}

	public function setEstadoNotEqual($estadoNotEqual)
	{
	    $this->estadoNotEqual = $estadoNotEqual;
	}
	
	public function ventasHoy(){
	
		$this->setFecha( new \Datetime() );

	}
	
	
	public function ventasSemanaActual(){

		$fechaDesde = LpnklfUtils::getFirstDayOfWeek( new \Datetime() );
		$fechaHasta = LpnklfUtils::getLastDayOfWeek( new \Datetime());
	
		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}
			
	public function ventasMesActual(){

		$fechaDesde = LpnklfUtils::getFirstDayOfMonth( new \Datetime() );
		$fechaHasta = LpnklfUtils::getLastDayOfMonth( new \Datetime());
	
		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
			
	}
	
	public function ventasAnioActual(){

		$fechaDesde = LpnklfUtils::getFirstDayOfYear( new \Datetime() );
		$fechaHasta = LpnklfUtils::getLastDayOfYear( new \Datetime());
	
		$this->setFechaDesde( $fechaDesde );
		$this->setFechaHasta( $fechaHasta );
	}						
				
	public function ventasImpagas(){

		$this->setEstados( array(EstadoVenta::PagadaParcialmente,EstadoVenta::Impaga) );
			
	}				

	public function ventasAnuladas(){

		$this->setEstado( EstadoVenta::Anulada );
	}
}
<?php

namespace Lpnklf\UI\components\form\servicioTecnico;

use Lpnklf\UI\components\filter\model\UIServicioTecnicoCriteria;

use Lpnklf\UI\service\finder\ServicioTecnicoFinder;

use Lpnklf\UI\components\filter\model\UITipoProductoCriteria;

use Lpnklf\UI\service\finder\TipoProductoFinder;

use Lpnklf\UI\components\filter\model\UIEstadoCriteria;

use Lpnklf\UI\service\finder\EstadoFinder;

use Lpnklf\UI\components\filter\model\UIMarcaProductoCriteria;

use Lpnklf\UI\service\finder\MarcaProductoFinder;

use Lpnklf\UI\components\filter\model\UIClienteCriteria;

use Lpnklf\UI\service\finder\ClienteFinder;

use Lpnklf\UI\utils\LpnklfUIUtils;

use Lpnklf\UI\service\UIServiceFactory;

use Rasty\utils\LinkBuilder;


use Rasty\Forms\form\Form;

use Rasty\components\RastyComponent;
use Rasty\utils\XTemplate;
use Rasty\utils\RastyUtils;


use Lpnklf\Core\model\ServicioTecnico;
use Lpnklf\Core\model\Prioridad;

use Lpnklf\Core\model\TipoProducto;
use Lpnklf\Core\model\MarcaProducto;
use Lpnklf\Core\model\Cliente;



/**
 * Formulario para servicioTecnico

 * @author Marcos
 * @since 08/03/2018
 */
class ServicioTecnicoForm extends Form{
		
	

	/**
	 * label para el cancel
	 * @var string
	 */
	private $labelCancel;
	

	/**
	 * 
	 * @var ServicioTecnico
	 */
	private $servicioTecnico;
	
	private $fecha;
	
	private $hora;
	public function __construct(){

		parent::__construct();
		$this->setLabelCancel("form.cancelar");
		
		$this->addProperty("fecha");
		
		$this->addProperty("tipoProducto");
		$this->addProperty("cliente");
		$this->addProperty("prioridad");
		$this->addProperty("marcaProducto");
		$this->addProperty("modelo");
		$this->addProperty("detalleFalla");
		$this->addProperty("fuente");
		$this->addProperty("bateria");
		$this->addProperty("clave");
		$this->addProperty("observaciones");
		$this->addProperty("reparaHasta");
		$this->addProperty("diagnostico");
		$this->addProperty("solucion");
		$this->addProperty("diasDemora");
		$this->addProperty("monto");
		$this->addProperty("estadoServicio");
		
		$this->setBackToOnSuccess("ServiciosTecnico");
		$this->setBackToOnCancel("ServiciosTecnico");
		
	}
	
	public function getOid(){
		
		return $this->getComponentById("oid")->getPopulatedValue( $this->getMethod() );
	}
	
	
	public function getType(){
		
		return "ServicioTecnicoForm";
		
	}
	
	public function fillEntity($entity){
		
		parent::fillEntity($entity);
		
		
		$fecha = LpnklfUIUtils::newDateTime( RastyUtils::getParamPOST("fecha") );
		$hora = LpnklfUIUtils::newDateTime( RastyUtils::getParamPOST("hora") );
		$fechaHora = new \DateTime();
		$fechaHora->setDate( $fecha->format("Y"), $fecha->format("m"), $fecha->format("d") );
		$fechaHora->setTime( $hora->format("H"), $hora->format("i"), $hora->format("s") );
		$entity->setFecha($fechaHora);
		
		
	}

	protected function parseXTemplate(XTemplate $xtpl){

		parent::parseXTemplate($xtpl);
		
		
		$xtpl->assign("cancel", $this->getLinkCancel() );
		$xtpl->assign("lbl_cancel", $this->localize( $this->getLabelCancel() ) );
		
		$xtpl->assign("lbl_fecha", $this->localize("servicioTecnico.fecha") );
		$xtpl->assign("lbl_tipoProducto", $this->localize("servicioTecnico.tipoProducto") );
		$xtpl->assign("lbl_cliente", $this->localize("servicioTecnico.cliente") );
		$xtpl->assign("lbl_modelo", $this->localize("servicioTecnico.modelo") );
		$xtpl->assign("lbl_marcaProducto", $this->localize("servicioTecnico.marcaProducto") );
		$xtpl->assign("lbl_detalleFalla", $this->localize("servicioTecnico.detalleFalla") );
		$xtpl->assign("lbl_fuente", $this->localize("servicioTecnico.fuente") );
		$xtpl->assign("lbl_bateria", $this->localize("servicioTecnico.bateria") );
		$xtpl->assign("lbl_clave", $this->localize("servicioTecnico.clave") );
		$xtpl->assign("lbl_observaciones", $this->localize("servicioTecnico.observaciones") );
		$xtpl->assign("lbl_reparaHasta", $this->localize("servicioTecnico.reparaHasta") );
		$xtpl->assign("lbl_prioridad", $this->localize("servicioTecnico.prioridad") );
		$xtpl->assign("lbl_diagnostico", $this->localize("servicioTecnico.diagnostico") );
		$xtpl->assign("lbl_solucion", $this->localize("servicioTecnico.solucion") );
		$xtpl->assign("lbl_diasDemora", $this->localize("servicioTecnico.diasDemora") );
		$xtpl->assign("lbl_monto", $this->localize("servicioTecnico.monto") );
		$xtpl->assign("lbl_estadoServicio", $this->localize("servicioTecnico.estadoServicio") );
	}


	public function getLabelCancel()
	{
	    return $this->labelCancel;
	}

	public function setLabelCancel($labelCancel)
	{
	    $this->labelCancel = $labelCancel;
	}


	
	public function getServicioTecnico()
	{
	    return $this->servicioTecnico;
	}

	public function setServicioTecnico($servicioTecnico)
	{
	    $this->servicioTecnico = $servicioTecnico;
		//setea la fecha y la hora.
		if(!empty($servicioTecnico)){

			$fechaHora = $servicioTecnico->getFecha();
			if(!empty($fechaHora)){
				$fecha = new \Datetime();
				$hora = new \Datetime();
				$fecha->setDate( $fechaHora->format("Y"), $fechaHora->format("m"), $fechaHora->format("d") );
				$hora->setTime( $fechaHora->format("H"), $fechaHora->format("i"), $fechaHora->format("s") );
				$this->setFecha($fecha);
				$this->setHora($hora);
			}
		}
	    
	}
	
	public function getLinkCancel(){
		$params = array();
		
		return LinkBuilder::getPageUrl( $this->getBackToOnCancel() , $params) ;
	}

	public function getPrioridades(){
		
		return LpnklfUIUtils::localizeEntities(Prioridad::getItems());
	}
	

	public function getTipoProductoFinderClazz(){
		
		return get_class( new TipoProductoFinder() );
		
	}	
	
	public function getTiposProducto(){
		$criteria = new UITipoProductoCriteria();
		$criteria->setServicioTecnico(2);
		$criteria->addOrder("nombre", "ASC");
		$tiposProducto = UIServiceFactory::getUITipoProductoService()->getList( $criteria );
		
		return $tiposProducto;
	}
	
	public function getEstadoFinderClazz(){
		
		return get_class( new EstadoFinder() );
		
	}	
	
	public function getEstados(){
		
		$estados = UIServiceFactory::getUIEstadoService()->getList( new UIEstadoCriteria() );
		
		return $estados;
	}
	
	public function getMarcaProductoFinderClazz(){
		
		return get_class( new MarcaProductoFinder() );
		
	}	
	
	
	public function getMarcasProducto(){
		$criteria = new UIMarcaProductoCriteria();
		
		$criteria->addOrder("nombre", "ASC");
		$marcasProducto = UIServiceFactory::getUIMarcaProductoService()->getList( $criteria);
		
		return $marcasProducto;
	}
	
	public function getClienteFinderClazz(){
		
		return get_class( new ClienteFinder() );
		
	}	
	
	
	public function getClientes(){
		$criteria = new UIClienteCriteria();
		
		$criteria->addOrder("nombre", "ASC");
		$ivas = UIServiceFactory::getUIClienteService()->getList( $criteria );
		
		return $ivas;
	}

	

	public function getFecha()
	{
	    return $this->fecha;
	}

	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	}

	public function getHora()
	{
	    return $this->hora;
	}

	public function setHora($hora)
	{
	    $this->hora = $hora;
	}
	
	public function getLinkActionAgregarCliente(){
		
		return LinkBuilder::getActionUrl( "AgregarCliente") ;
		
	}
}
?>
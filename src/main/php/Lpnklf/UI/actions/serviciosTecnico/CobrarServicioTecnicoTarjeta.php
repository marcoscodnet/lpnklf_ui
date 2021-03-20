<?php
namespace Lpnklf\UI\actions\serviciosTecnico;


use Lpnklf\UI\components\form\servicioTecnico\ServicioTecnicoCobrarTarjetaForm;
use Lpnklf\UI\components\filter\model\UITarjetaCriteria;

use Lpnklf\UI\service\UIServiceFactory;
use Lpnklf\Core\model\Tarjeta;

use Rasty\actions\Action;
use Rasty\actions\Forward;
use Rasty\utils\RastyUtils;
use Rasty\exception\RastyException;

use Rasty\security\RastySecurityContext;

use Rasty\i18n\Locale;
use Rasty\factory\PageFactory;
use Rasty\exception\RastyDuplicatedException;
use Rasty\Forms\input\InputNumber;
use Lpnklf\Core\utils\LpnklfUtils;

use Rasty\utils\Logger;

/**
 * se realiza el alta de un cobro de servicioTecnico por tarjeta.
 * 
 * @author Marcos
 * @since 05/04/2018
 */
class CobrarServicioTecnicoTarjeta extends Action{

	
	public function execute(){

		$forward = new Forward();

		$page = PageFactory::build("ServicioTecnicoCobrarTarjeta");
		
		$servicioTecnicoCobrarTarjetaForm = $page->getComponentById("servicioTecnicoCobrarTarjetaForm");
		
		try {

			//creamos una nueva servicioTecnicoCobrarTarjeta.
			$tarjeta = new Tarjeta();
			
			//completados con los datos del formulario.
			$servicioTecnicoCobrarTarjetaForm->fillEntity($tarjeta);
			
			//Logger::log('Busca la servicioTecnico');
			
			$servicioTecnicoOid = RastyUtils::getParamPOST("servicioTecnicoOid");
			$servicioTecnico = UIServiceFactory::getUIServicioTecnicoService()->get( $servicioTecnicoOid );
			
			$clienteOid = RastyUtils::getParamPOST("clienteOid");
			$cliente = UIServiceFactory::getUIClienteService()->get( $clienteOid );
			
			
			
			try {
				$criteria = new UITarjetaCriteria();
				$criteria->setCliente($cliente);
				$criteria->setNro(RastyUtils::getParamPOST("nro"));
				
				
				$tarjetaCliente = UIServiceFactory::getUITarjetaService()->getByCriteria( $criteria );
				//Logger::log("tarjeta: ".$tarjetaCliente->getOid());
			
				$tarjeta = UIServiceFactory::getUITarjetaService()->get($tarjetaCliente->getOid());
			}	
			 catch (RastyException $e) {
				//Logger::log('No encuentra la tarjeta');
				$tarjeta->setFecha( new \Datetime() );
				$tarjeta->setNumero(RastyUtils::getParamPOST("nro") );
				$tarjeta->setCliente( $cliente );
				$tarjeta->setSaldoInicial( 0 );
				UIServiceFactory::getUITarjetaService()->add( $tarjeta );
			}
			//Logger::logObject($tarjeta);
			$number = new InputNumber();
			$monto = $number->formatValue( RastyUtils::getParamPOST("monto") );
			//$observaciones = RastyUtils::getParamPOST("observaciones");
			
			
			
			
			//Logger::log('Busca la cuenta');
			$cuenta = UIServiceFactory::getUICuentaService()->get($tarjeta->getOid());
			
			
			$user = RastySecurityContext::getUser();
			$user = LpnklfUtils::getUserByUsername($user->getUsername());
			
			UIServiceFactory::getUIServicioTecnicoService()->cobrar($servicioTecnico, $cuenta, $user, $monto);	
			
			
			$forward->setPageName( $servicioTecnicoCobrarTarjetaForm->getBackToOnSuccess() );
						
		
			$servicioTecnicoCobrarTarjetaForm->cleanSavedProperties();
			
		
		} catch (RastyException $e) {
		
			$forward->setPageName( "ServicioTecnicoCobrarTarjeta" );
			$forward->addError( Locale::localize($e->getMessage())  );
			
			//guardamos lo ingresado en el form.
			$servicioTecnicoCobrarTarjetaForm->save();
		}
		
		return $forward;
		
	}

}
?>
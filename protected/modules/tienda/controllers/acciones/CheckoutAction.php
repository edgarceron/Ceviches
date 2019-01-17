<?php
include "lib/PayU.php";

class CheckoutAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $direccion = $_POST['direccion'];
		$medio_pago = $_POST['medio_pago'];
		$fecha = $_POST['fecha'];
		$items_string = $_POST['items_string'];
		$telefono = $_POST['telefono'];
		
		unset($_POST['telefono']);
		$user = SofintUsers::model()->findByPk(Yii::app()->user->id);
		$email = $user['nick'];
		$firstName = $user['nombre'];
		$lastName = $user['apellido'];
		
		$temporal = new TemporalPedido;
		$temporal->attributes = $_POST;
		$temporal->save();
		$id_pedido = $temporal['id'];
		
		$items = Carrito::cargarPorCadena($items_string);
		
		$total = 0;
		$contador = 0;
		foreach($items as $d){
			$item = $d['item'];
			$jsonitem = json_encode($item);
			$id = $item['id'];
			unset($item['id']);
			$variables = $item;
			$cantidad = $d['cantidad'];
			
			$producto = Productos::model()->findByPk($id);
			$nombre = $producto['nombre_producto'];
			$precio = $producto['precio_producto'];
			$foto = "productos/$id/" . $producto['imagenp_producto'];
			
			
			
			$aumento = 0;
			$variable_str = "";
			foreach(array_keys($variables) as $v){
				$idv = $variables[$v];
				$vp = VariablesProducto::model()->find("id_producto = $id AND id_tipo_variable = $v AND id_variable= $idv");
				$var = Variables::model()->findByPk($idv);
				$variable_str .= $var['descripcion_tipo_variable']. ",";
				if($vp != null){
					if($vp['afecta_precio'] == 1){
						$precio = $vp['precio'];
					}
					else if($vp['afecta_precio'] == 2){
						$aumento += $vp['precio'];
					}
				}
			}
			$variable_str = substr($variable_str, 0, -1);
			$precio += $aumento;
			$total += ($cantidad * $precio);
			
			$order['products'][$contador]['name'] = $nombre ." ".$variable_str;
			$order['products'][$contador]['unitPrice'] = $precio;
			$order['products'][$contador]['quantity'] = $cantidad;
			
			$contador++;
		}
	
	///////////////////////////////////////////////////////////////////////////////////////////////
		PayU::$apiKey = "4Vj8eK4rloUd272L48hsrarnUA"; //Ingrese aquí su propio apiKey.
		PayU::$apiLogin = "pRRXKOl8ikMmt9u"; //Ingrese aquí su propio apiLogin.
		PayU::$merchantId = "508029"; //Ingrese aquí su Id de Comercio.
		PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
		PayU::$isTest = true; //Dejarlo True cuando sean pruebas.
		
		// URL de Pagos
		Environment::setPaymentsCustomUrl("https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi");
		// URL de Consultas
		Environment::setReportsCustomUrl("https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi");
		// URL de Suscripciones para Pagos Recurrentes
		Environment::setSubscriptionsCustomUrl("https://sandbox.api.payulatam.com/payments-api/rest/v4.3/");
			
		$reference = "payment_test_00000001";
		$value = "20000";

		$parameters = array(
			//Ingrese aquí el identificador de la cuenta.
			PayUParameters::ACCOUNT_ID => "512321",
			//Ingrese aquí el código de referencia.
			PayUParameters::REFERENCE_CODE => $reference,
			//Ingrese aquí la descripción.
			PayUParameters::DESCRIPTION => "payment test",

			// -- Valores --
			//Ingrese aquí el valor de la transacción.
			PayUParameters::VALUE => $value,
			//Ingrese aquí el valor del IVA (Impuesto al Valor Agregado solo valido para Colombia) de la transacción,
			//si se envía el IVA nulo el sistema aplicará el 19% automáticamente. Puede contener dos dígitos decimales.
			//Ej: 19000.00. En caso de no tener IVA debe enviarse en 0.
			PayUParameters::TAX_VALUE => "0",
			//Ingrese aquí el valor base sobre el cual se calcula el IVA (solo valido para Colombia).
			//En caso de que no tenga IVA debe enviarse en 0.
			PayUParameters::TAX_RETURN_BASE => "0",
			//Ingrese aquí la moneda.
			PayUParameters::CURRENCY => "COP",

			// -- Comprador
			//Ingrese aquí el nombre del comprador.
			PayUParameters::BUYER_NAME => "First name and second buyer name",
			//Ingrese aquí el email del comprador.
			PayUParameters::BUYER_EMAIL => "buyer_test@test.com",
			//Ingrese aquí el teléfono de contacto del comprador.
			PayUParameters::BUYER_CONTACT_PHONE => "7563126",
			//Ingrese aquí el documento de contacto del comprador.
			PayUParameters::BUYER_DNI => "5415668464654",
			//Ingrese aquí la dirección del comprador.
			PayUParameters::BUYER_STREET => "calle 100",
			PayUParameters::BUYER_STREET_2 => "5555487",
			PayUParameters::BUYER_CITY => "Medellin",
			PayUParameters::BUYER_STATE => "Antioquia",
			PayUParameters::BUYER_COUNTRY => "CO",
			PayUParameters::BUYER_POSTAL_CODE => "000000",
			PayUParameters::BUYER_PHONE => "7563126",

			// -- pagador --
			//Ingrese aquí el nombre del pagador.
			PayUParameters::PAYER_NAME => "First name and second payer name",
			//Ingrese aquí el email del pagador.
			PayUParameters::PAYER_EMAIL => "payer_test@test.com",
			//Ingrese aquí el teléfono de contacto del pagador.
			PayUParameters::PAYER_CONTACT_PHONE => "7563126",
			//Ingrese aquí el documento de contacto del pagador.
			PayUParameters::PAYER_DNI => "5415668464654",
			//Ingrese aquí la dirección del pagador.
			PayUParameters::PAYER_STREET => "calle 93",
			PayUParameters::PAYER_STREET_2 => "125544",
			PayUParameters::PAYER_CITY => "Bogota",
			PayUParameters::PAYER_STATE => "Bogota",
			PayUParameters::PAYER_COUNTRY => "CO",
			PayUParameters::PAYER_POSTAL_CODE => "000000",
			PayUParameters::PAYER_PHONE => "7563126",

			// -- Datos de la tarjeta de crédito --
			//Ingrese aquí el número de la tarjeta de crédito
			PayUParameters::CREDIT_CARD_NUMBER => "4097440000000004",
			//Ingrese aquí la fecha de vencimiento de la tarjeta de crédito
			PayUParameters::CREDIT_CARD_EXPIRATION_DATE => "2019/12",
			//Ingrese aquí el código de seguridad de la tarjeta de crédito
			PayUParameters::CREDIT_CARD_SECURITY_CODE=> "321",
			//Ingrese aquí el nombre de la tarjeta de crédito
			//VISA||MASTERCARD||AMEX||DINERS
			PayUParameters::PAYMENT_METHOD => "VISA",

			//Ingrese aquí el número de cuotas.
			PayUParameters::INSTALLMENTS_NUMBER => "1",
			//Ingrese aquí el nombre del pais.
			PayUParameters::COUNTRY => PayUCountries::CO,

			//Session id del device.
			PayUParameters::DEVICE_SESSION_ID => "vghs6tvkcle931686k1900o6e1",
			//IP del pagadador
			PayUParameters::IP_ADDRESS => "127.0.0.1",
			//Cookie de la sesión actual.
			PayUParameters::PAYER_COOKIE=>"pt1t38347bs6jc9ruv2ecpv7o2",
			//Cookie de la sesión actual.
			PayUParameters::USER_AGENT=>"Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0"
		);

		$response = PayUPayments::doAuthorizationAndCapture($parameters);

		if ($response) {
			$response->transactionResponse->orderId;
			$response->transactionResponse->transactionId;
			$response->transactionResponse->state;
			if ($response->transactionResponse->state=="PENDING") {
				$response->transactionResponse->pendingReason;
			}
			//$response->transactionResponse->paymentNetworkResponseCode;
			//$response->transactionResponse->paymentNetworkResponseErrorMessage;
			//$response->transactionResponse->trazabilityCode;
			//$response->transactionResponse->responseCode;
			//$response->transactionResponse->responseMessage;
		}
		
	/////////////////////////////////////////////////////////////
    }
}


<?php
include "vendor/autoload.php";

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
		
		//set Sandbox Environment
		OpenPayU_Configuration::setEnvironment('sandbox');

		//set POS ID and Second MD5 Key (from merchant admin panel)
		OpenPayU_Configuration::setMerchantPosId('348840');
		OpenPayU_Configuration::setSignatureKey('4d80d19193ccdf5998f321b44eec7376');
		
		//set Oauth Client Id and Oauth Client Secret (from merchant admin panel)
		OpenPayU_Configuration::setOauthClientId('348840');
		OpenPayU_Configuration::setOauthClientSecret('01e3721cadea40e4640d189bd5854026');
		
		$order['continueUrl'] = Yii::app()->createAbsoluteUrl('/tienda/default/crearPedido/', array('tipo' => 'payu', 'id' => $id)); //customer will be redirected to this page after successfull payment
		//$order['notifyUrl'] = 'http://localhost/';
		$order['customerIp'] = $_SERVER['REMOTE_ADDR'];
		$order['merchantPosId'] = OpenPayU_Configuration::getMerchantPosId();
		$order['description'] = 'Pedido #' . $id_pedido;
		$order['currencyCode'] = 'PLN';
		$order['totalAmount'] = $total;
		$order['extOrderId'] = $id_pedido; //must be unique!
		//optional section buyer
		$order['buyer']['email'] = $email;
		$order['buyer']['phone'] = $telefono;
		$order['buyer']['firstName'] = $firstName;
		$order['buyer']['lastName'] = $lastName;

		$response = OpenPayU_Order::create($order);
		$this->controller->redirect($response->getResponse()->redirectUri);
    }
}


<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

class CrearPedidoAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {
		$tipo = '';
		if(isset($_GET['tipo'])){
			$tipo = $_GET['tipo'];
			$id_temporal = $_GET['id'];
			$id_ciudad =  $_GET['id_ciudad'];
			$id_direccion = $_GET['id_direccion'];
			$state_pol =  $_POST['state_pol'];
			if($state_pol != 4){
				Yii::app()->user->setFlash('warning', 'Hubo un error durante la transacción o la transacción fue anulada');
				//$this->controller->redirect(Yii::app()->createUrl('/tienda/default/finalizarPedido'));
				$temporal = TemporalPedido::model()->findByPk($id_temporal);
				$temporal['id_pedido_finalizado'] = 0;
				$temporal->save();
				exit;
			}
		}
		
		if($tipo == 'payu'){
			$temporal = TemporalPedido::model()->findByPk($id_temporal);
			$direccion = $temporal['direccion'];
			$medio_pago = $temporal['medio_pago'];
			$fecha = $temporal['fecha'];
			$items_string = $temporal['items_string'];
			$payment_type = 3;
		}
		else{
			$direccion = $_POST['direccion'];
			$medio_pago = $_POST['medio_pago'];
			$fecha = $_POST['fecha'];
			$items_string = $_POST['items_string'];
			$id_ciudad = $_POST['id_ciudad'];
			$id_direccion = $_POST['id_direccion'];
			$payment_type = 1;
		}
		
		$pedido = new Pedidos;
		$pedido['id_usuario_pedido'] = Yii::app()->user->id;
		$pedido['fecha_pedido'] = date('Y-m-d H:i:s');
		$pedido['estado_pedido'] = "Recibido"; 
		$pedido['direccion_pedido'] = $direccion;
		if($medio_pago == 1){
			$cadena_medio_pago = "Efectivo";
		}
		else{
			$cadena_medio_pago = "PayU";
		}
		$pedido['medio_pago_pedido'] = $cadena_medio_pago;
		$pedido['cookie_pedido'] = $items_string;
		$pedido['domicilio_pedido']  = OpcionesTienda::getOpcion('valor_domicilio');
		
		$luigi = $this->generarCodigoLuigi();
		$pedido['luigi_pedido'] = $luigi;
		
		$items = Carrito::cargarPorCadena($items_string);
		
		
		if($pedido->save()){
			$id_pedido = $pedido['id'];
			//Crea la programacion para el pedido
			$this->crearProgramacion($fecha, $id_pedido);
			
			//Cargar articulos a la table de detalles
			$total = $this->crearDetalles($items, $id_pedido);
			$pedido->save();
			
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$correo = $usuario['nick'];
			$nombre = $usuario['nombre'] . ' ' . $usuario['apellido'];
			
			$this->llamarMensajerosMU($total, $id_pedido, $payment_type, $id_direccion, $items);
			
			$this->enviarCorreo($correo, $nombre, $pedido);
			
			if($tipo != 'payu'){
				Carrito::borrarCookie();
				$this->controller->redirect(Yii::app()->createUrl('/tienda/default/thankYou',array(
					'id_pedido' => $pedido['id'],
					'luigi' => $pedido['luigi_pedido'],
				)));
			}
			else{
				$temporal['id_pedido_finalizado'] = $pedido['id'];
				$temporal->save();
			}
		}
		else{
			//Redireccion a una pagina de error
			if($tipo != 'payu'){
				print_r($pedido);
			}
		}
    }
	
	/**
	 * Crea la programación para un pedido
	 * @param $fecha String de la fecha en formato AAAA-MM-DD HH:MM:SS
	 * @param $id_pedido id del pedido al que se añadiran los detalles
	 */
	public function crearProgramacion($fecha, $id_pedido){
		if($fecha != '' && $fecha != '0000-00-00 00:00:00'){
			$programacion = new ProgramacionPedido;
			$programacion['id_pedido'] = $id_pedido;
			$programacion['fecha_programada'] = $fecha;
			$programacion->save();
		}
	}
	
	/**
	 * Creas los detalles de un pedido en la tabla de detalles
	 * @param $items Datos de los items a ser añadidos
	 * @param $id_pedido id del pedido al que se añadiran los detalles
	 * @return double Valor total de los detalles
	 */
	public function crearDetalles($items, $id_pedido){
		$total = 0;
		foreach($items as $d){
			$item = $d['item'];
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
			
			$detalle = new Detalles;
			$detalle['id_pedido'] = $id_pedido;
			$detalle['descripcion_detalle'] = $nombre ." ".$variable_str;
			$detalle['valor_unitario_detalle'] = $precio;
			$detalle['cantidad_detalle'] = $cantidad;
			$detalle['foto_detalle'] = $foto;
			$detalle->save();
		}
		return $total;
	}
	
	/**
	 * Envia un correo con el enlacce para recuperación de contraseña
	 * @param $usuario CActiveRecord del usuario
	 * @return bool true si el correo fue enviado, false en caso contrario
	 */	
	public function enviarCorreo($email, $nombre, $pedido){
		
		$mail = new PHPMailer;
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$id_pedido = $pedido['id'];
			$detalles = Detalles::model()->findAll('id_pedido = ' . $id_pedido);
			$adjunto = $this->construirMensaje($email, $nombre, $pedido, $detalles);
			$mail->IsSMTP();
			$mail->Host = gethostbyname($this->getOpcion('host'));
			$mail->Port = intval($this->getOpcion('port'));
			$mail->CharSet = 'utf-8';
			//$mail->SMTPDebug = 1;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->SMTPSecure = "ssl";
			$mail->SMTPAuth = true;
			$mail->Username = $this->getOpcion('email');
			$mail->Password = base64_decode($this->getOpcion('password'));
			$mail->setFrom($this->getOpcion('email'), 'CevicheYMar Webmaster');
			$mail->Subject = 'Pedido en ceviche y mar';
			$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
			$mail->msgHTML($adjunto);
			$mail->AddAddress($email, $nombre);	
			if(!$mail->send()) {
			  echo '<br>Message was not sent.<br>';
			  echo 'Mailer error: ' . $mail->ErrorInfo;
			  return false;
			} 
			return true;
		}
		return false;
	}
	
	/**
	 * Construye una pagina html con los datos de la recuperación de contraseña
	 * @param $nick Nick del usuario
	 * @param $nombre Nombre del usuario
	 * @param $codigo Codigo de la url generada para la recuperación
	 * @return String con el html de la pagina
	 */
	public function construirMensaje($mail, $nombre, $pedido, $detalles){
		$url = '/index.php/tienda/default/verPedido/id_pedido/' . $pedido['id'];
		$rutaImagenes =  '/images/';	
		return $this->controller->renderPartial('plantilla_correo_pedido', 
			array(
				'mail' => $mail, 
				'nombre' => $nombre, 
				'pedido' => $pedido, 
				'detalles' => $detalles, 
				'url' => $url, 
				'rutaImagenes' => $rutaImagenes), true);
	}
		
	/**
	 * Adquiere un registro de la tabla de opciones
	 * @param $parametro String con el nombre del parametro a optener
	 * @return String valor del parametro, null si no existe el parametro
	 */
	public function getOpcion($parametro){
		$record = Opciones::model()->find('opcion = "' . $parametro . '"');
		if($record != null){
			return $record['valor'];
		}
		return null;
	}
	
	/**
	 * Genera un codigo en base al momento actual
	 * @return String codigo generado
	 */
	public function generarCodigoLuigi(){
		$numero = strtotime(date('Y-m-d H:i:s'));
		$contador = 0;
		$resultado = array();
		while(true){
			$division = $numero / 36;
			$residuo = $numero % 36;
			$numero = floor($division);	
			$resultado[$contador] = $this->retornarBase36($residuo);
			$contador++;
			if($numero < 36) break;
		}
		
		$codigo = "";
		for($i = count($resultado) - 1;$i >=0; $i--){
			$codigo = $codigo . $resultado[$i];
		}
		
		while(true){
			$repetido = Pedidos::model()->find('luigi_pedido = "' . $codigo . '"');
			if($repetido == null){
				return $codigo;
			}
		}
	}
	
	/**
	 * Genera un simbolo para representar una base numerica de 36 
	 * (Numeros del 0-9, letras A-Z)
	 * @param $numero int Numero en base 10 entre 0 y 35
	 * @return char El simbolo que representa el numero en base 36
	 */
	public function retornarBase36($numero){
		switch($numero){
			case 0:return 0;break;
			case 1:return 1;break;
			case 2:return 2;break;
			case 3:return 3;break;
			case 4:return 4;break;
			case 5:return 5;break;
			case 6:return 6;break;
			case 7:return 7;break;
			case 8:return 8;break;
			case 9:return 9;break;
			case 10:return 'A';break;
			case 11:return 'B';break;
			case 12:return 'C';break;
			case 13:return 'D';break;
			case 14:return 'E';break;
			case 15:return 'F';break;
			case 16:return 'G';break;
			case 17:return 'H';break;
			case 18:return 'I';break;
			case 19:return 'J';break;
			case 20:return 'K';break;
			case 21:return 'L';break;
			case 22:return 'M';break;
			case 23:return 'N';break;
			case 24:return 'O';break;
			case 25:return 'P';break;
			case 26:return 'Q';break;
			case 27:return 'R';break;
			case 28:return 'S';break;
			case 29:return 'T';break;
			case 30:return 'U';break;
			case 31:return 'V';break;
			case 32:return 'W';break;
			case 33:return 'X';break;
			case 34:return 'Y';break;
			case 35:return 'Z';break;
		}
	}
	
	/**
	 * Genera un array de productos con los datos requeridos por el api de mensajerosurbanos
	 * @param $items Array con la información de los items
	 * @return array con los items en formato mensajerosurbanos
	 */
	public function generarProductosMU($items){
		$productos = array();
		foreach($items as $d){
			$item = $d['item'];
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
			$productos[] = [
				"store_id"=> intval(OpcionesTienda::model()->find('descripcion = "store_id"')['valor']), 
				"sku"=> "1020651",
				"product_name"=> $nombre ." ".$variable_str, //Nombre del producto
				"url_img"=> substr(Yii::app()->createAbsoluteUrl(''), 0, -9) . "images/" . $foto, //URL de la image
				"value"=> $precio, //valor total
				"quantity"=> $cantidad, //cantidad
				"id_point"=> "1", //Identificador del punto creado
				"barcode"=> "", //Codigo de barras
				"planogram"=> "-"
			];
		}
		return $productos;
	}
	
	public function llamarMensajerosMU($total, $id_pedido, $payment_type, $id_direccion, $items){
		$record = Direcciones::model()->findByPk($id_direccion);
		$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
		$nombre = $usuario['nombre'] . ' ' . $usuario['apellido'];
		$direccion = $record['linea1_direccion'] . ' ' . $record['linea2_direccion'];
		$telefono = $record['telefono_direccion'];
		$correo = $usuario['nick'];
		$productos = $this->generarProductosMU($items);
		$access_token = OpcionesTienda::model()->find('descripcion = "access_token_mu"')['valor'];
		
		$parametros = [
			"id_user" => intval(OpcionesTienda::model()->find('descripcion = "id_user_mu"')['valor']), // ID de usuario
			"type_service"=> 4, //Tipo de servicio
			"roundtrip"=> 0, //1=Ida y vuelta;0=solo ida
			"declared_value"=> $total, //Valor de productos de domicilio
			"city"=> intval(OpcionesTienda::model()->find('descripcion = "ciudad_id_mu"')['valor']),  //Id de ciudad *tabla
			"start_date"=> date('Y-m-d'), //Fecha
			"start_time"=> date('H:i:s'), //Hora
			"observation"=> "CYM" . $id_pedido , //Descripción General
			"user_payment_type"=> $payment_type, //Tipo de pago del usuario *Tabla
			"type_segmentation"=> 1, //Tipo de segmentación *Tabla
			"type_task_cargo_id"=> 2, //Tipo de carga
			"os"=> "NEW API 2.0", //Versión de Api
			"coordinates"=> [ array(
				"type"=> "1", //TIPO DE DATO
				"id_point"=> "2",
				"order_id"=> $id_pedido, //número de orden
				"address"=> $direccion,//Dirección cliente
				"token"=> $id_pedido, //Token de seguimiento
				"city"=>"cali", //Nombre ciudad *tabla
				"description"=> "Favor cobrar lo que dice la factura",//DESCRIPCIÓN
				"client_data"=> [
					"client_name"=> $nombre,//Nombre del cliente
					"client_phone"=> $telefono, //Teléfono
					"client_email"=> $correo, //correo
					"products_value"=> $total, //Valor total de productos
					"domicile_value"=> OpcionesTienda::model()->find('descripcion = "valor_domicilio"')['valor'], //Valor domicilios
					"client_document"=> "79170747",//Documento
					"payment_type"=> $payment_type //TIpo de pago
				],
				"products"=> $productos
			)]
		];
		
		$url = "http://dev.api.mensajerosurbanos.com/delivery/create";
		$post = json_encode($parametros);
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, ["access_token: $access_token", 'Content-Type: application/json']); 

		$result=curl_exec ($ch);
		curl_close($ch);
		$obj = json_decode($result, true);
		
		$status_code = $obj['status_code'];
		if($status_code == 200){
			$data = $obj['data'];
			$data['id_pedido'] = $id_pedido;
			$servicio = new ServiciosMu;
			$servicio->attributes = $data;
			$servicio->save();
		}
	}
}


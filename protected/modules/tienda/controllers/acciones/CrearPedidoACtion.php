<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

class CrearPedidoAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $direccion = $_POST['direccion'];
		$medio_pago = $_POST['medio_pago'];
		$fecha = $_POST['fecha'];
		$items_string = $_POST['items_string'];
		
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
		while(true){
			$luigi = $this->generarCodigoLuigi();
			$repetido = Pedidos::model()->find('luigi_pedido = "' . $luigi . '"');
			if($repetido == null){
				break;
			}
		}
		
		$pedido['luigi_pedido'] = $luigi;
		$items = Carrito::cargarPorCadena($items_string);
		
		
		if($pedido->save()){
			if($fecha){
				$programacion = new ProgramacionPedido;
				$programacion['id_pedido'] = $pedido['id'];
				$programacion['fecha_programada'] = $fecha;
				$programacion->save();
			}
			//Cargar articulos a la table de detalles
			$total = 0;
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
				
				$total += ($cantidad * $precio);
				
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
				
				$detalle = new Detalles;
				$detalle['id_pedido'] = $pedido['id'];
				$detalle['descripcion_detalle'] = $nombre ." ".$variable_str;
				$detalle['valor_unitario_detalle'] = $precio;
				$detalle['cantidad_detalle'] = $cantidad;
				$detalle['foto_detalle'] = $foto;
				$detalle->save();
			}
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$correo = $usuario['nick'];
			$nombre = $usuario['nombre'] . ' ' . $usuario['apellido'];
			$this->enviarCorreo($correo, $nombre, $pedido);
			Carrito::borrarCookie();
			$this->controller->redirect(Yii::app()->createUrl('/tienda/default/thankYou',array(
				'id_pedido' => $pedido['id'],
				'luigi' => $pedido['luigi_pedido'],
			)));
		}
		else{
			//Redireccion a una pagina de error
			print_r($pedido);
		}
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
			$mail->Host = gethostbyname('smtp.gmail.com');
			$mail->Port = 587;
			$mail->CharSet = 'utf-8';
			//$mail->SMTPDebug = 1;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->SMTPSecure = "tls";
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
		$url = 'https://cevicheymar.com/Ceviches/index.php/tienda/default/verPedido/id_pedido/' . $pedido['id'];
		$rutaImagenes =  'https://cevicheymar.com/Ceviches/images/';	
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
	 * Adquiere un registro de la table de opciones
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
		
		return $codigo;
	}
	
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
}


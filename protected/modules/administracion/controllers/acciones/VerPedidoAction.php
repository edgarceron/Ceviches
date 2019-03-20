<?php
class VerPedidoAction extends CAction {
	
	public function run($id_pedido){
		$pedido = Pedidos::model()->findByPk($id_pedido);
		$detalles = Detalles::model()->findAll('id_pedido = ' . $id_pedido);
		
		$programcion = ProgramacionPedido::model()->find('id_pedido = ' . $pedido['id']);
		if($programcion == null){
			$c = "danger";
			$mensaje = "Pedido para ya! Debe llegar en 55 minutos o menos";
		}
		else{
			$fecha = $programcion['fecha_programada'];
			$c = "alert";
			$mensaje = "Pedido para $fecha, atención";
		}
		
		if(isset($_POST['Pedidos']['estado_pedido'])){
			$pedido['estado_pedido'] = $_POST['Pedidos']['estado_pedido'];
			$pedido->save();
		}
		
		$id_usuario = $pedido['id_usuario_pedido'];
		$usuario = SofintUsers::model()->findByPk($id_usuario);
		
		$servicio_mu = ServiciosMu::model()->findByPk($id_pedido);
		$detalle_mu = array();
		$uuid = 0;
		if($servicio_mu != null){
			if($servicio_mu['task_id'] == null){
				$this->getTaskIdServicios(1);
			}
			$uuid = ServiciosMu::model()->findByPk($id_pedido)['uuid'];
			$detalle_mu = $this->detalleServicio($uuid);
		}
		
		$this->controller->render('vista_pedido', array(
			'id_pedido' => $id_pedido,
			'pedido' => $pedido,
			'detalles' => $detalles,
			'usuario' => $usuario,
			'c' => $c,
			'mensaje' => $mensaje,
			'detalle_mu' => $detalle_mu,
			'uuid' => $uuid,
		));
	}
	
	public function detalleServicio($uuid){
		$access_token = OpcionesTienda::getOpcion('access_token');
		$parametros = [
			"id_user" => intval(OpcionesTienda::model()->find('descripcion = "id_user_mu"')['valor']), // ID de usuario
			"uuid"=> $uuid, 
			"access_token" => $access_token,
		];
		
		$url = "http://dev.api.mensajerosurbanos.com/task";
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
		print_r($obj);
		exit;
		$detalle = array();
		if($obj['status_code'] == 200){	
			$data = $obj['data'];
			$detalle['total_value'] = $data['total_value'];
			$detalle['status'] = $data['status'];
			$detalle['addresses'] = $data['address'];
			$detalle['history'] = $data['history'];
		}
		return $detalle;
	}
	
	public function getTaskIdServicios($page){
		$parametros = $this->crearParametrosMU($page);
		
		$url = "http://dev.api.mensajerosurbanos.com/tasksP";
		$post = json_encode($parametros);
		$ch = curl_init();
		$access_token = OpcionesTienda::getOpcion('access_token');
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, ["access_token: $access_token", 'Content-Type: application/json']); 
		
		$result=curl_exec ($ch);
		curl_close($ch);
		$obj = json_decode($result, true);
		
		if($obj['status_code'] == 200){
			$data = $obj['data'];
			$pages = $data['total_pages'];
			$servicios = $data["result"];
			$this->asingarTaskId($servicios);
			if($page < $pages){
				$this->getTaskIdServicios(++$page);
			}
		}
	}
	
	public function asingarTaskId($servicios){
		foreach($servicios as $servicio){
			$uuid = $servicio['uuid'];
			$servicio_mu = ServiciosMu::model()->find('uuid = "' . $uuid .  '"');
			$servicio_mu['task_id'] = $servicio['task_id'];
			$servicio_mu->save();
		}
	}
	
	public function crearParametrosMU($page){
		$parametros = [
			"id_user" => intval(OpcionesTienda::model()->find('descripcion = "id_user_mu"')['valor']), // ID de usuario
			"type"=> 1, //Tipo de servicio
			"page"=> $page, 
		];
		return $parametros;
	}
	
}
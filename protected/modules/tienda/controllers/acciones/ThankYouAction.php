<?php
class ThankYouAction extends CAction {
	
	public function run(){
		
		$id_pedido = $_GET['id_pedido'];
		$luigi = $_GET['luigi'];
		$fecha_programada = ProgramacionPedido::model()->find('id_pedido = ' . $id_pedido);
		if($fecha_programada == null){
			$mensaje = "Su pedido llegara en 55 minutos o menos";
		}
		else{
			$mensaje = "Su pedido llegara en la siguiente fecha: " . $fecha_programada['fecha_programada'];
		}
		$this->controller->layout = '//layouts/full';
		$this->controller->render('thankYou', array(
			'id_pedido' => $id_pedido,
			'luigi' => $luigi,
			'mensaje' => $mensaje,
		));
	}
	
}
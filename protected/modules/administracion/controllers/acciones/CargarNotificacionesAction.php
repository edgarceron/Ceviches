<?php
class CargarNotificacionesAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
		$criteria = new CDbCriteria;
		$criteria->select = 'id, id_usuario_pedido, fecha_pedido';
		$criteria->addCondition('estado_pedido = "Recibido"');
		$pedidos = Pedidos::model()->findAll($criteria);
		
		$notificaciones = array();
		foreach($pedidos as $pedido){
			$id_usuario = $pedido['id_usuario_pedido'];
			$usuario = SofintUsers::model()->findByPk($id_usuario);
			$nombre_usuario = $usuario['nombre'] . " " . $usuario['apellido'];
			$notificacion['nombre_usuario'] = substr($nombre_usuario, 0, 20) . "...";
			$notificacion['id_pedido'] = $pedido['id'];
			$notificacion['fecha'] = $pedido['fecha_pedido'];
			$notificaciones[] = $notificacion;
		}
		

        $html = $this->controller->renderPartial(
			'notificaciones',
			array(
				'notificaciones' => $notificaciones,
			),
			true
		);
		
		$numero_notificaciones = count($notificaciones);
		
		echo $html . "--" . $numero_notificaciones;
    }
}


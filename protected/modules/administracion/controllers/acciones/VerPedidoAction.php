<?php
class VerPedidoAction extends CAction {
	
	public function run($id_pedido){
		$pedido = Pedidos::model()->findByPk($id_pedido);
		$detalles = Detalles::model()->findAll('id_pedido = ' . $id_pedido);
		
		if(isset($_POST['Pedidos']['estado_pedido'])){
			$pedido['estado_pedido'] = $_POST['Pedidos']['estado_pedido'];
			$pedido->save();
		}
		
		$id_usuario = $pedido['id_usuario_pedido'];
		$usuario = SofintUsers::model()->findByPk($id_usuario);
		
		$this->controller->render('vista_pedido', array(
			'id_pedido' => $id_pedido,
			'pedido' => $pedido,
			'detalles' => $detalles,
			'usuario' => $usuario,
		));
	}
	
}
<?php
class VerPedidoAction extends CAction {
	
	public function run(){
		$id_pedido = $_GET['id_pedido'];
		$pedido = Pedidos::model()->findByPk($id_pedido);
		$detalles = Detalles::model()->findAll('id_pedido = ' . $id_pedido);
		$this->controller->render('vista_pedido', array(
			'pedido' => $pedido,
			'detalles' => $detalles,
		));
	}
	
}
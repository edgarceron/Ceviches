<?php
class ThankYouAction extends CAction {
	
	public function run(){
		$id_pedido = $_GET['id_pedido'];
		$luigi = $_GET['luigi'];
		$this->controller->layout = '//layouts/full';
		$this->controller->render('thankYou', array(
			'id_pedido' => $id_pedido,
			'luigi' => $luigi,
		));
	}
	
}
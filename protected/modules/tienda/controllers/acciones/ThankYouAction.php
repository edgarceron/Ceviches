<?php
class ThankYouAction extends CAction {
	
	public function run(){
		$id_pedido = $_GET['id_pedido'];
		$this->controller->render('thankYou', array(
			'id_pedido' => $id_pedido,
		));
	}
	
}
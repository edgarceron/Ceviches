<?php
class DeleteItemAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {       
		//unset(Yii::app()->request->cookies['carrito']);
        $id = $_GET['id'];
		unset($_GET['id']);
		unset($_GET['_']);
		$variables = $_GET;
		Carrito::deleteItem($id, $variables);
		//$this->controller->redirect('cargarCarrito');
    }
}

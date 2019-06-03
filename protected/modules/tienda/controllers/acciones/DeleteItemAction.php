<?php
class DeleteItemAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {       
		//unset(Yii::app()->request->cookies['carrito']);
				$id = $_GET['id'];
				$cantidad = $_GET['cantidad'];
			unset($_GET['id']);
			unset($_GET['cantidad']);
			unset($_GET['_']);
			$variables = $_GET;
			Carrito::deleteItem($id, $variables);

			$producto = Productos::model()->findByPk($id);
			echo json_encode(array('id' => $id, 'name' => $producto['nombre_producto'], 'qty' => $cantidad));
			//$this->controller->redirect('cargarCarrito');
    }
}


<?php
class CambiarCantidadAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {       
		//unset(Yii::app()->request->cookies['carrito']);
				$item = $_GET['item'];
        $id = $item['id'];
				unset($item['id']);
				$variables = $item;
				$cantidad = $_GET['cantidad'];
				Carrito::cambiarCantidad($id, $variables, $cantidad);
				$this->controller->redirect('cargarCarrito');
    }
}


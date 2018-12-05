<?php
class CargarCarritoAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {       
		$carrito = Yii::app()->request->cookies->contains('carrito') ?
			Yii::app()->request->cookies['carrito']->value : false;
		if($carrito){
			$items = Carrito::getItems();
			$this->controller->renderPartial('carrito', array('items' => $items));
		}
		else{
			echo '<small class="text-muted">Aun no tiene articulos en su carrito de compras</small>' ;
		}
    }
}


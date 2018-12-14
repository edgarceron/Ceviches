<?php
class CargarCarritoAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {
		$items = Carrito::getItems();
		$this->controller->renderPartial('carrito', array('items' => $items));		
    }
}


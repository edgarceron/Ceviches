<?php
class CargarCarritoAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {
		$items = Carrito::getItems();
		$html = $this->controller->renderPartial('carrito', array('items' => $items), true);	
		$numero = Carrito::getNumeroItems();
		echo $html . "--" . $numero;
    }
}


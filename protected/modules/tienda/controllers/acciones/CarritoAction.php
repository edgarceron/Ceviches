<?php
class CarritoAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
		$items = Carrito::getItems();

        $this->controller->render('administrar_carrito',array(
			'items' => $items
        ));
    }
}


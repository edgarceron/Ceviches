<?php
class CarritoAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $carrito = Yii::app()->request->cookies->contains('carrito') ?
			Yii::app()->request->cookies['carrito']->value : false;
		if($carrito){
			$items = Carrito::getItems();
		}
		else{
			$items = array();
		}

        $this->controller->render('administrar_carrito',array(
			'items' => $items
        ));
    }
}


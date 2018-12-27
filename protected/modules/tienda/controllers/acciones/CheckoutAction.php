<?php
class CheckoutAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $direccion = $_POST['direccion'];
		$medio_pago = $_POST['medio_pago'];
		$fecha = $_POST['fecha'];
		$items_string = $_POST['items_string'];

		$this->controller->redirect(Yii::app()->createUrl('pagoPayU',array(
		
		)));
		
			
    }
}


<?php
class CheckoutAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $id_direccion = $_POST['direccion'];
		$medio_pago = $_POST['medio_pago'];
		
		if($medio_pago == 1){
			$this->controller->redirect(Yii::app()->createUrl('tienda/default/crearPedido',array(
				'id_direccion' => $id_direccion,
				'medio_pago' => $medio_pago,
			)));
		}
		else if($medio_pago == 2){
			$this->controller->redirect(Yii::app()->createUrl('pagoPayU',array(
			
			)));
		}
        
    }
}


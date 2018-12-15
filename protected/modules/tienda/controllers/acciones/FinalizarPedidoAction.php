<?php
class FinalizarPedidoAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                   
		if(Yii::app()->user->name == "Guest"){
			Yii::app()->user->setFlash('success', "Debe iniciar sesión o crear una cuenta antes de finalizar el pedido");
			Yii::app()->user->returnUrl = Yii::app()->createUrl('/tienda/default/finalizarPedido');
			$this->controller->redirect(Yii::app()->createUrl('/site/login'));
		}
		else{
			$items = Carrito::getItems();
			if($items != array()){
				$items = Carrito::getItems();
				$id_usuario = Yii::app()->user->id;
				$direcciones = Direcciones::model()->findAll('usuario_direccion = ' . $id_usuario);
				$lista_direcciones = array();
				foreach($direcciones as $direccion){
					$desc = $direccion['nombre_direccion'] . ": " . $direccion['linea1_direccion'] . " " . $direccion['linea2_direccion'];
					if(strlen($desc) >= 30){
						$desc = substr($desc, 0, 30) . "...";
					}
					$lista_direcciones[$direccion['id']] = $desc;
				}
				$this->controller->render('finalizar_pedido',array(
					'items' => $items,
					'lista_direcciones' => $lista_direcciones,
				));
			}
			else{
				Yii::app()->user->setFlash('success', "Debe tener articulos en su carrito de compras para proceder a finalizar su pedido");
				$this->controller->redirect(Yii::app()->createUrl(''));
			}
		}
    }
}


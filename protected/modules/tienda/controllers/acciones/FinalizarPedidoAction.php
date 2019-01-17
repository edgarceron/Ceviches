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
			
			if(isset($_GET['programacion'])){
				$programacion = $_GET['programacion'];
			}
			else{
				$programacion = 1;
			}
			
			if(isset($_GET['fecha'])){
				$fecha = $_GET['fecha'];
			}
			else{
				$fecha = '';
			}
			
			if(isset($_GET['hora'])){
				$hora = $_GET['hora'];
			}
			else{
				$hora = '';
			}
			
			if($items != array()){
				$items = Carrito::getItems();
				$items_string = Carrito::getItemsString();
				$id_usuario = Yii::app()->user->id;
				$direcciones = Direcciones::model()->findAll('usuario_direccion = ' . $id_usuario);
				$lista_direcciones = array(0 => 'Seleccione o cree una dirección');
				foreach($direcciones as $direccion){
					$desc = $direccion['nombre_direccion'] . ": " . $direccion['linea1_direccion'] . " " . $direccion['linea2_direccion'];
					if(strlen($desc) >= 30){
						$desc = substr($desc, 0, 30) . "...";
					}
					$lista_direcciones[$direccion['id']] = $desc;
				}
				$this->controller->render('finalizar_pedido',array(
					'items' => $items,
					'items_string' => $items_string,
					'lista_direcciones' => $lista_direcciones,
					'fecha' => $fecha,
					'hora' => $hora,
					'programacion' => $programacion,
				));
			}
			else{
				Yii::app()->user->setFlash('success', "Debe tener articulos en su carrito de compras para proceder a finalizar su pedido");
				$this->controller->redirect(Yii::app()->createUrl(''));
			}
		}
    }
}


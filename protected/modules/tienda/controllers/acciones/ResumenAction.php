<?php
class ResumenAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $id_direccion = $_POST['direccion'];
		$medio_pago = $_POST['medio_pago'];
		$programacion = $_POST['programacion'];
		$items_string = $_POST['items_string'];
		
		$direccion = Direcciones::model()->findByPk($id_direccion);
		$ciudad = Ciudades::model()->findByPk($direccion['ciudad_direccion']);
		$direccion_texto = $direccion['linea1_direccion'] . " " . $direccion['linea2_direccion'] . " Telefono: " . $direccion['telefono_direccion'] . " Ciudad: " . $ciudad['nombre_ciudad'];
		$_POST['direccion'] = $direccion_texto;
		
		$temporal = new TemporalPedido;
		$temporal->attributes = $_POST;
		$temporal->save();
		$id_pedido = $temporal['id'];
		
		$user_id = Yii::app()->user->id;
		$user = SofintUsers::model()->findByPk($user_id);
		$email = $user['nick'];
		$nombre_completo = $user['nombre'] . " " . $user['apellido'];
			
		$fecha = '';
		$hora = '';
		$fecha_hora = false;
		if($programacion == 2){
			$error_fecha = true;
			$hora_apertura = OpcionesTienda::getOpcion('HORA_APERTURA');
			$hora_cierre = OpcionesTienda::getOpcion('HORA_CIERRE');
						
			if(isset( $_POST['fecha']) && isset( $_POST['hora'])){
				$fecha = $_POST['fecha'];
				$hora = $_POST['hora'];
				
				if($hora != '' && $fecha != ''){

					$fecha_hora = strtotime($fecha . ' ' . $hora);
					$ahora = strtotime(date('Y-m-d H:i:s')) + 3600 * 4;
					if($fecha_hora >= $ahora){
						$apertura = strtotime($fecha . ' ' . $hora_apertura);
						$cierre = strtotime($fecha . ' ' . $hora_cierre);
						if($fecha_hora > $apertura && $fecha_hora < $cierre){
							$error_fecha = false;
						}
					}
				}
			}
			
			if($error_fecha){
				Yii::app()->user->setFlash('danger', "Si realiza un pedido para despues tenga en cuenta 
				que la fecha del pedido debe ser al menos 4 horas mayor que la fecha actual y que debe 
				ser en el horario laboral (entre $hora_apertura y $hora_cierre");
				
				$this->controller->redirect(Yii::app()->createUrl('tienda/default/finalizarPedido', 
				array('programacion' => $programacion, 'fecha' => $fecha, 'hora' => $hora)));
			}
		}
		
		$items = Carrito::cargarPorCadena($items_string);
		$this->controller->render('resumen',array(
			'direccion' => $direccion,
			'ciudad' => $ciudad,
			'id_ciudad' => $direccion['ciudad_direccion'],
			'items' => $items,
			'items_string' => $items_string,
			'medio_pago' => $medio_pago,
			'programacion' => $programacion,
			'fecha' => $fecha . ' ' . $hora,
			'id_pedido' => $id_pedido,
			'nombre_completo' => $nombre_completo,
			'email' => $email,
			'direccion_texto' => $direccion_texto,
			'valor_domicilio' => OpcionesTienda::getOpcion('valor_domicilio'),
		));
		
			
    }
}


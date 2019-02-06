<?php
class ThankYouAction extends CAction {
	
	public function run(){
		if(isset($_GET['tipo']) && $_GET['tipo'] == 'payu'){
			sleep(5);
			$id_temporal = $_GET['id_pedido'];
			$temporal = TemporalPedido::model()->findByPk($id_temporal);
			if($temporal['id_pedido_finalizado'] != 0){
				$pedido = Pedidos::model()->findByPk($temporal['id_pedido_finalizado']);
				$id_pedido = $pedido['id'];
				$luigi = $pedido['luigi_pedido'];
			}
			else{
				$this->controller->renderText('Ocurrio un error durante la transacción');
			}
		}
		else{
			$id_pedido = $_GET['id_pedido'];
			$luigi = $_GET['luigi'];
		}
		$fecha_programada = ProgramacionPedido::model()->find('id_pedido = ' . $id_pedido);
		if($fecha_programada == null){
			$mensaje = "Su pedido llegara en 55 minutos o menos";
		}
		else{
			$mensaje = "Su pedido llegara en la siguiente fecha: " . $fecha_programada['fecha_programada'];
		}
		$this->controller->layout = '//layouts/full';
		
		$post = [
			"id_user" => Opciones::model()->find('opcion = "id_user_mu"')['valor'], // ID de usuario
			"type_service"=> 4, //Tipo de servicio
			"roundtrip"=> 0, //1=Ida y vuelta;0=solo ida
			"declared_value"=> 1110, //Valor de productos de domicilio
			"city"=> 1, //Id de ciudad *tabla
			"start_date"=> "2017-04-18", //Fecha
			"start_time"=> "15:59:00", //Hora
			"observation"=> "Descripcion" , //Descripción General
			"user_payment_type"=> 1, //Tipo de pago del usuario *Tabla
			"type_segmentation"=> 1, //Tipo de segmentación *Tabla
			"type_task_cargo_id"=> 2, //Tipo de carga
			"os"=> "NEW API 2.0", //Versión de Api
			"coordinates"=> [ //COORDENADAS
				"type"=> "1", //TIPO DE DATO
				"id_point"=> "2",
				"order_id"=> 471, //número de orden
				"address"=> "Calle 166 # 48 21",//Dirección cliente
				"token"=> 234, //Token de seguimiento
				"city"=> "bogota", //Nombre ciudad *tabla
				"description"=> "Favor cobrar lo que dice la factura",//DESCRIPCIÓN
				"client_data"=> [
					"client_name"=> "Diego Poveda",//Nombre del cliente
					"client_phone"=> "3105580003", //Teléfono
					"client_email"=> "", //correo
					"products_value"=> "10000", //Valor total de productos
					"domicile_value"=> "0", //Valor domicilios
					"client_document"=> "79170747",//Documento
					"payment_type"=> 1 //TIpo de pago
				],
				"products"=> [
					[//PRODUCTOS
						"store_id"=> 26, //ID DE LA TIENDA
						"sku"=> "1020651", //SKU
						"product_name"=> "Afelius 50 Frasco X60ml.", //Nombre del producto
						"url_img"=>
						"http://images.com/ww746242.jpg", //URL de la image
						"value"=> 92100, //valor total
						"quantity"=> 1, //cantidad
						"id_point"=> "1", //Identificador del punto creado
						"barcode"=> "770050843", //Codigo de barras
						"planogram"=> "-"
					],
					[
						"store_id"=> 12,
						"sku"=> "1020651",
						"product_name"=> "CCCCCCC.",
						"url_img"=> "http://images.com/ww74242.jpg",
						"value"=> 92100,
						"quantity"=> 1,
						"id_point"=> "1",
						"barcode"=> "7707355050843",
						"planogram"=> "CUIDADO SOLAR (4L)"
					]
				]
			]
		];
		
		$this->controller->render('thankYou', array(
			'id_pedido' => $id_pedido,
			'luigi' => $luigi,
			'mensaje' => $mensaje,
			'id_user' => Opciones::model()->find('opcion = "id_user_mu"')['valor'],
			'access_token' => Opciones::model()->find('opcion = "access_token_mu"')['valor'],
		));
	}
	
}
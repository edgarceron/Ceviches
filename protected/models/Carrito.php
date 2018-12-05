<?php
	
class Carrito{
	
	/**
	 *
	 */
	private static $items;
	
	/**
	 * Añade un item al carrito
	 * @param $id int con el id del producto
	 * @param $variables array con las variables del productos separas como 'id_tipo_variable' => 'id_variable'
	 * @return bool true si se añadio el item, false en caso contrario
	 */
	public static function addItem($id, $variables, $cantidad = 1){
		
		self::cargarCookieCarrito();
		$item['id'] = $id;
		$ak = array_keys($variables);
		foreach ($ak as $v){
			$item[$v] = $variables[$v];
		}
		$existe = false;
		for($i = 0; $i < count(self::$items); $i++){
			if(self::$items[$i]['item'] == $item){
				self::$items[$i]['cantidad']+= $cantidad;
				$existe = true;
				break;
			}
		}
		if(!$existe) array_push(self::$items, array('item' => $item, 'cantidad' => $cantidad));
		self::guardarCookieCarrito();
	}
	
	/**
	 * Borra un item del carrito
	 * @param $id int con el id del producto
	 * @param $variables array con las variables del productos separas como 'id_tipo_variable' => 'id_variable'
	 * @return bool true si se borro el item, false en caso contrario
	 */
	public static function deleteItem($id, $variables){
		self::cargarCookieCarrito();
		$item['id'] = $id;
		$ak = array_keys($variables);
		foreach ($ak as $v){
			$item[$v] = $variables[$v];
		}
		
		for($i = 0; $i < count(self::$items); $i++){
			if(self::$items[$i]['item'] == $item){
				unset(self::$items[$i]);
				self::guardarCookieCarrito();
				if(count(self::$items) <= 0){
					unset(Yii::app()->request->cookies['carrito']);
				}
				return true;
			}
		}
		return false;
	}
	
	public static function cambiarCantidad($id, $variables, $cantidad){
		self::cargarCookieCarrito();
		$item['id'] = $id;
		$ak = array_keys($variables);
		foreach ($ak as $v){
			$item[$v] = $variables[$v];
		}
		
		for($i = 0; $i < count(self::$items); $i++){
			if(self::$items[$i]['item'] == $item){
				if($cantidad > 0){
					self::$items[$i]['cantidad'] = $cantidad;
					self::guardarCookieCarrito();
					return true;	
				}
				else{
					unset(self::$items[$i]);
					if(count(self::$items) <= 0){
						unset(Yii::app()->request->cookies['carrito']);
					}
					else{
						self::guardarCookieCarrito();
					}
				}
			}
		}
		return false;
	}	
	
	/**
	 * Convierte el array de items en un string para guardarlo en una cookie
	 * @return String
	 */
	public static function itemsToString(){
		/*
		Separador de items ;
		Separador de propiedades ,
		Separador de valores :
		Separador de cantidad *
		*/
		$items_string = '';
		foreach (self::$items as $detalle){
			$item = $detalle['item'];
			$cantidad = $detalle['cantidad'];
			$item_string = '' . $item['id'];
			unset($item['id']);
			foreach(array_keys($item) as $v){
				$item_string .= "," . $v . ":" . $item[$v];
			}
			$item_string .= "*" . $cantidad;
			if($items_string == ''){
				$items_string = $item_string;
			}
			else{
				$items_string .= ";" . $item_string;
			}
		}
		return $items_string;
	}
	
	public static function cargarCookieCarrito(){
		
		self::$items = array();
		$carrito = Yii::app()->request->cookies->contains('carrito') ?
			Yii::app()->request->cookies['carrito']->value : false;
		if($carrito){
			$detalles = explode(";", $carrito);
			foreach($detalles as $d){
				$detalle = explode("*", $d);
				$item_string = $detalle[0];
				$cantidad = $detalle[1];
				$item_array =  explode("," , $item_string);
				$id = $item_array[0];
				unset($item_array[0]);
				foreach($item_array as $propiedad){
					$p_array = explode(":", $propiedad);
					$propiedades[$p_array[0]] = $p_array[1];
				}
				$item['id'] = $id;
				$ak = array_keys($propiedades);
				foreach ($ak as $v){
					$item[$v] = $propiedades[$v];
				}
				array_push(self::$items, array('item' => $item, 'cantidad' => $cantidad));
			}
		}
	}
	
	public static function guardarCookieCarrito(){
		$items_string = self::itemsToString();
		Yii::app()->request->cookies['carrito'] = new CHttpCookie('carrito', $items_string);
	}
	
	public static function getItems(){
		self::cargarCookieCarrito();
		return self::$items;
	}
}
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
					self::borrarCookie();
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
						self::borrarCookie();
					}
					else{
						self::guardarCookieCarrito();
					}
					return true;	
				}
			}
		}
		return false;
	}	
	
	
	public static function borrarCookie(){
		if(Yii::app()->user->name != "Guest"){
			$id_usuario = Yii::app()->user->id;
			$cookie = Cookies::model()->find('id_usuario = ' . $id_usuario);
			if($cookie != null){
				$cookie->delete();
			}
		}
		if(Yii::app()->request->cookies->contains('carrito')){
			unset(Yii::app()->request->cookies['carrito']);
		} 
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
		//self::cargarCookieCarrito();
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
	
	public static function getItemsString(){
		self::cargarCookieCarrito();
		return self::itemsToString();
	}
	
	public static function cargarCookieCarrito(){
		
		self::$items = array();
		$carrito = Yii::app()->request->cookies->contains('carrito') ?
			Yii::app()->request->cookies['carrito']->value : false;
		if($carrito){
			self::procesarCadena($carrito);
		}
		if(Yii::app()->user->name != "Guest"){
			$id_usuario = Yii::app()->user->id;
			$cookie = Cookies::model()->find('id_usuario = ' . $id_usuario);
			if($cookie != null){
				$cadena_cookie = $cookie['cadena_cookie'];
				if($carrito){
					if($carrito != $cadena_cookie){
						self::procesarCadena($cadena_cookie);
					}
				}
				else{
					self::procesarCadena($cadena_cookie);
				}
			}
		}
	}
	
	public static function cargarPorCadena($str){
		self::procesarCadena($str);
		return self::$items;
	}
	
	public static function procesarCadena($cadena_cookie){
		$detalles = explode(";", $cadena_cookie);
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
			
			$existe = false;
			for($i = 0; $i < count(self::$items); $i++){
				if(self::$items[$i]['item'] == $item){
					self::$items[$i]['cantidad']+= $cantidad;
					$existe = true;
					break;
				}
			}
			if(!$existe) array_push(self::$items, array('item' => $item, 'cantidad' => $cantidad));
		}
	}
	
	public static function guardarCookieCarrito(){
		$items_string = self::itemsToString();
		Yii::app()->request->cookies['carrito'] = new CHttpCookie('carrito', $items_string);
		if(Yii::app()->user->name != "Guest"){
			$id_usuario = Yii::app()->user->id;
			$cookie = Cookies::model()->find('id_usuario = ' . $id_usuario);
			if($cookie == null){
				$cookie = new Cookies;
				$cookie['id_usuario'] = $id_usuario;
			}
			$cookie['cadena_cookie'] = $items_string;
			$cookie['fecha_creacion_cookie'] = date('Y-m-d');
			$cookie->save();
		}
	}
	
	public static function getItems(){
		self::cargarCookieCarrito();
		return self::$items;
	}
	
	public static function setItems($items){
		self::$items = $items;
		self::guardarCookieCarrito();
	}
}
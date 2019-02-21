<?php
class VerProductoAction extends CAction {
	
	public function run($id){
		
		$com = "CALL producto($id)";
		$productos = Yii::app()->tienda->createCommand($com)->queryAll();
		$producto = $this->crearProductos($productos);
		
		$this->controller->render('vista_producto', array(
			'producto' => $producto[$id],
			'id' => $id,
		));
	}
	
	public function crearProductos($productos){
		$productos_catalogo = array();
		foreach($productos as $p){
			$id = $p['id'];
			$estado_p = Productos::model()->findByPk($id)['estado_producto'];
			if(!isset($productos_catalogo[$id])){
				if($estado_p){
					$nombre = $p['nombre_producto'];
					$precio_p = $p['precio_producto'];
					$imagen = $p['imageng_producto'];
					$linea = $p['id_linea_producto'];
					$descripcion = $p['descripcion_producto'];
					
					$productos_catalogo[$id] = array('nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio_p, 'linea'=> $linea, 'imagen' => $imagen);
				}
			}
			
			if($estado_p){
				$nombre_tipo_variable = $p['id_tipo_variable'];
				$id_variable_producto = $p['id_variable_producto'];
				$descripcion = $p['descripcion_tipo_variable'];
				$afecta = $p['afecta_precio'];
				$precio_v = $p['precio'];
				
				$productos_catalogo[$id]['variables'][$nombre_tipo_variable][$id_variable_producto] = array('descripcion' => $descripcion, 'afecta_precio' => $afecta, 'precio' => $precio_v);
			}
		}
		
		$ak = array_keys($productos_catalogo);
		foreach($ak as $k){
			 ksort($productos_catalogo[$k]['variables']);
			 $akv = array_keys($productos_catalogo[$k]['variables']);
			 foreach($akv as $v) ksort($productos_catalogo[$k]['variables'][$v]);
		}
		
		return $productos_catalogo;
	}
	
}
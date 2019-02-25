<?php
class IndexAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $id_catalogo = OpcionesTienda::getOpcion('CATALAGO_PRINCIPAL');
		$productos_catalogo = array();
		$tipo_catalogo = 0;
		if($id_catalogo != ''){
			$catalogo = Catalogos::model()->findByPk($id_catalogo);
			$tipo_catalogo = $catalogo->orden_catalogo;
			if($catalogo != null){
				$com = "CALL lineasCatalogo($id_catalogo)";
				$lineas = Yii::app()->tienda->createCommand($com)->queryAll();
				
				$com = "CALL productosCatalogo($id_catalogo)";
				$productos = Yii::app()->tienda->createCommand($com)->queryAll();
				$productos_catalogo = $this->crearProductos($productos);
			}
		}

        $this->controller->render('index',array(
			"productos_catalogo" => $productos_catalogo,
			"tipo_catalogo" => $tipo_catalogo,
			"lineas" => $lineas,
        ));
    }
	
	public function crearProductos($productos){
		$productos_catalogo = array();
		foreach($productos as $p){
			$id = $p['id_producto'];
			if(!isset($productos_catalogo[$id])){
				$estado_p = Productos::model()->findByPk($id)['estado_producto'];
				if($estado_p){
					$nombre = $p['nombre_producto'];
					$precio_p = $p['precio_producto'];
					$imagen = $p['imagenm_producto'];
					$linea = $p['id_linea_producto'];
					$productos_catalogo[$id] = array('nombre' => $nombre, 'precio' => $precio_p, 'linea'=> $linea, 'imagen' => $imagen);
				}
			}
			else{
				$estado_p = Productos::model()->findByPk($id)['estado_producto'];
			}
			
			if($estado_p){
				if( $p['id_tipo_variable'] != null){
					$nombre_tipo_variable = $p['id_tipo_variable'];
					$id_variable_producto = $p['id_variable_producto'];
					$descripcion = $p['descripcion_tipo_variable'];
					$afecta = $p['afecta_precio'];
					$precio_v = $p['precio'];
					$productos_catalogo[$id]['variables'][$nombre_tipo_variable][$id_variable_producto] = array('descripcion' => $descripcion, 'afecta_precio' => $afecta, 'precio' => $precio_v);
				}
			}
		}
		
		$ak = array_keys($productos_catalogo);
		foreach($ak as $k){
			if(isset($productos_catalogo[$k]['variables'])){
			    ksort($productos_catalogo[$k]['variables']);
				$akv = array_keys($productos_catalogo[$k]['variables']);
				foreach($akv as $v) ksort($productos_catalogo[$k]['variables'][$v]);
			}
		}
		
		return $productos_catalogo;
	}
}


<?php
class ListCatalogosAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        if(isset($_GET['nombre'])){
			$nombre = $_GET['nombre'];
		}
		else{
			$nombre = '';
		}
		
		if(isset($_GET['orden'])){
			$orden = $_GET['orden'];
		}
		else{
			$orden = '';
		}
		
		
		$model = new Catalogos;
		$criteria = new CDbCriteria;
		$criteria->addCondition('nombre_catalogo LIKE "%'. $nombre . '%"');
		if($orden != '')
			$criteria->compare('orden_catalogo', $orden);
		
		$reporte = new CActiveDataProvider($model, array('criteria' => $criteria));
		$errores = "";
		
		$lista_orden = array(1 => "Por posición", 2 => "Por linea de producto");
		$lista_orden[''] = "Cualquier forma de ordenamiento";
		ksort($lista_orden);

        $this->controller->render('lista_catalogos',array(
			'nombre' => $nombre,
			'orden' => $orden,
			'lista_orden' => $lista_orden,
			'errores' => $errores,
			'dataProvider' => $reporte,
        ));
    }
}


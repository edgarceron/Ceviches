<?php
class ListLineasProductoAction extends CAction
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
		
		
		$model = new LineasProducto;
		$criteria = new CDbCriteria;
		$criteria->addCondition('nombre_linea_producto LIKE "%'. $nombre . '%"');

		
		$reporte = new CActiveDataProvider($model, array('criteria' => $criteria));
		$errores = "";

        $this->controller->render('lista_lineas',array(
			'nombre' => $nombre,
			'errores' => $errores,
			'dataProvider' => $reporte,
        ));
    }
}


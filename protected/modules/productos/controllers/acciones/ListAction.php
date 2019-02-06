<?php
class ListAction extends CAction
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
		
		if(isset($_GET['minimo'])){
			$minimo = str_replace(".", "", $_GET['minimo']);
			$minimo_ingresado = $_GET['minimo'];
		}
		else{
			$minimo = '';
			$minimo_ingresado = '';
		}
		
		if(isset($_GET['maximo'])){
			$maximo = str_replace(".", "", $_GET['maximo']);
			$maximo_ingresado = $_GET['maximo'];
		}
		else{
			$maximo = '';
			$maximo_ingresado = '';
		}
		
		if(isset($_GET['estado'])){
			$estado = $_GET['estado'];
		}
		else{
			$estado = '';
		}
		
		if(isset($_GET['tipo'])){
			$tipo = $_GET['tipo'];
		}
		else{
			$tipo = '';
		}
		
		if(isset($_GET['linea'])){
			$linea = $_GET['linea'];
		}
		else{
			$linea = '';
		}
		
		$model = new Productos;
		$criteria = new CDbCriteria;
		
		$errores = '';
		//Calculo de errores
		if($minimo != '' && !is_numeric($minimo)){
			$minimo = '';
			$errores = $errores . "- Desde debe ser un valor numerico<br>";
		}
		if($maximo != '' && !is_numeric($maximo)){
			$maximo = '';
			$errores = $errores . "- Hasta debe ser un valor numerico<br>";
		}
		//Fin del calculo de errores
		if($errores != ''){
			$errores = '<div class="alert alert-warning" role="alert">' . $errores . '</div>';
		}
		
		if($minimo == ''){
			$min = -1;
		}
		else{
			$min = $minimo;
		}
		
		if($maximo == ''){
			$max = 1000000000;
		}
		else{
			$max = $maximo;
		}
		
		$criteria->addCondition('precio_producto >= ' . $min . ' AND precio_producto <= ' . $max);
		$criteria->addCondition('nombre_producto LIKE "%'. $nombre . '%"');
		$criteria->compare('estado_producto', $estado);
		$criteria->compare('id_tipo_producto', $tipo);
		$criteria->compare('id_linea_producto', $linea);
		
		$reporte = new CActiveDataProvider($model, array('criteria' => $criteria));
		
		$tipos = CHtml::listData(TiposProducto::model()->findAll(), 'id', 'nombre_tipo_producto');
		$tipos[""] = 'Todas los tipos';
		ksort($tipos);
		
		$lineas = CHtml::listData(LineasProducto::model()->findAll(), 'id', 'nombre_linea_producto');
		$lineas[""] = 'Todas las lineas';
		ksort($lineas);

        $this->controller->render('lista',array(
			'nombre' => $nombre,
			'minimo' => $minimo,
			'maximo' => $maximo,
			'estado' => $estado,
			'tipo' => $tipo,
			'linea' => $linea,
			'errores' => $errores,
			'dataProvider' => $reporte,
			'tipos' => $tipos,
			'lineas' => $lineas,
        ));
    }
}


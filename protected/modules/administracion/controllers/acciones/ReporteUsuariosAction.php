<?php
class ReporteUsuariosAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {    
		if(isset($_GET['mes'])){
			$mes = $_GET['mes'];
		}
		else{
			$mes = '';
		}
		
		if(isset($_GET['ciudad'])){
			$ciudad = $_GET['ciudad'];
		}
		else{
			$ciudad = '';
		}
		
		if(isset($_GET['reporte'])){
			$reporte = $_GET['reporte'];
		}
		else{
			$reporte = '';
		}
		
		$meses = array(1=>"enero","febrero","marzo","abril","mayo","junio","julio",
					"agosto","septiembre","octubre","noviembre","diciembre");
		$meses[''] = "Cualquier mes";
		ksort($meses);
		
		if($ciudad != ''){
			$criteria = new CDbCriteria;
			$criteria->select = 'usuario_direccion';
			$criteria->group = 'usuario_direccion';
			$criteria->compare('ciudad_direccion', $ciudad);
			$usuarios = Direcciones::model()->findAll($criteria);
			$ids = array();
			foreach($usuarios as $u){
				$ids[] = $u['usuario_direccion'];
			}
		}
		
		$criteria = new CDbCriteria;
		if(isset($ids)){
			$criteria->addInCondition('id', $ids);
		}
		
		if(isset($mes) && $mes != ''){
			$criteria->addCondition("MONTH(fecha_nacimiento) = $mes");
		}
				
		if($reporte == ''){
			$dataProvider = new CActiveDataProvider(new SofintUsers, array('criteria' => $criteria));
			$lista_ciudades = CHtml::listData(Ciudades::model()->findAll(), 'id', 'nombre_ciudad');
			$inicial[''] = 'Cualquier ciudad';
			$ciudades = array_merge($inicial, $lista_ciudades);
			$this->controller->render('lista_usuarios',array(
				'dataProvider' => $dataProvider,
				'mes' => $mes,
				'meses' => $meses,
				'ciudad' => $ciudad,
				'ciudades' => $ciudades,
			));
		}
		else{
			$this->reporteCsv($criteria);
			$this->controller->redirect( Yii::app()->request->baseUrl .'/csv/reporte.csv');
		}
    }
	
	public function reporteCsv($criteria){
		$usuarios = SofintUsers::model()->findAll($criteria);
		$str_csv = "";
		foreach($usuarios as $usuario){
			$str_csv .= $usuario['nick'] . ";" . $usuario['nombre'] . ";" . $usuario['apellido'] . ";" . $usuario['fecha_nacimiento'] . "\n";
		}
		$webroot = Yii::getPathOfAlias('webroot');
		$str_csv= utf8_decode($str_csv);
		$file = $webroot . "/" . 'csv' . "/" . 'reporte.csv';
		$gestor = fopen($file, "w");
		fwrite($gestor, $str_csv);
		fclose($gestor);
	}
}


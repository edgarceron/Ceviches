<?php
class ReporteUsuariosAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        if(isset($_GET['desde'])){
			$desde = $_GET['desde'];
		}
		else{
			$desde = '';
		}
		
		if(isset($_GET['hasta'])){
			$hasta = $_GET['hasta'];
		}
		else{
			$hasta = '';
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
		
		if($desde != '' && $hasta != ''){
			$criteria->addCondition('fecha_pedido  BETWEEN "'.$desde.'" AND DATE_ADD("'.$hasta.'", INTERVAL 1 DAY)');
		}
		else if($desde != ''){
			$criteria->addCondition('fecha_pedido  > "'.$desde.'"');
		}
		else if($hasta != ''){
			$criteria->addCondition('fecha_pedido  < "'.$hasta.'"');
		}
		if($reporte == ''){
			
		
			$dataProvider = new CActiveDataProvider(new SofintUsers, array('criteria' => $criteria));
			$lista_ciudades = CHtml::listData(Ciudades::model()->findAll(), 'id', 'nombre_ciudad');
			$inicial[''] = 'Cualquier ciudad';
			$ciudades = array_merge($inicial, $lista_ciudades);
			$this->controller->render('lista_usuarios',array(
				'dataProvider' => $dataProvider,
				'desde' => $desde,
				'hasta' => $hasta,
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


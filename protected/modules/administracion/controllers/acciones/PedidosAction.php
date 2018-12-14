<?php
class PedidosAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        if(isset($_GET['desde'])){
			$desde = $_GET['desde'];
		}
		else{
			$desde = date('Y-m-d');
		}
		
		if(isset($_GET['hasta'])){
			$hasta = $_GET['hasta'];
		}
		else{
			$hasta = date('Y-m-d');
		}
		
		if(isset($_GET['minimo'])){
			$minimo = $_GET['minimo'];
		}
		else{
			$minimo = '';
		}
		
		if(isset($_GET['maximo'])){
			$maximo = $_GET['maximo'];
		}
		else{
			$maximo = '';
		}

		if(isset($_GET['nombre'])){
			$nombre = $_GET['nombre'];
		}
		else{
			$nombre = '';
		}
		
		if(isset($_GET['telefono'])){
			$telefono = $_GET['telefono'];
		}
		else{
			$telefono = '';
		}
		
		$errores = '';
		$model = new Pedidos;
		
		$criteria = new CDbCriteria;
		$criteria->select = 'id';
		
		if($nombre != ''){
			$criteria->addCondition('nombre LIKE "%'. $nombre . '%" OR apellido LIKE "%'. $nombre . '%"');
			//$criteria->addCondition('apellido LIKE "%'. $nombre . '%"');			
		}
		if($telefono != ''){
			$criteria->addCondition('telefono LIKE "%'. $telefono . '%"');
		}
		$usuarios = SofintUsers::model()->findAll($criteria);
		$ids = array();
		foreach($usuarios as $u){
			$ids[] = $u['id'];
		}
		
		
		$criteria = new CDbCriteria;
		
		if($desde != '' && $hasta != ''){
			$criteria->addCondition('fecha_pedido  BETWEEN "'.$desde.'" AND DATE_ADD("'.$hasta.'", INTERVAL 1 DAY)');
		}
		else if($desde != ''){
			$criteria->addCondition('fecha_pedido  > "'.$desde.'"');
		}
		else if($hasta != ''){
			$criteria->addCondition('fecha_pedido  < "'.$hasta.'"');
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
		
		if($nombre != '' || $telefono != ''){
			$criteria->addInCondition('id_usuario_pedido', $ids);
		}
		
		
		$criteria->order = 'fecha_pedido  DESC';
		
		
		
		$reporte = new CActiveDataProvider($model, array('criteria' => $criteria));
		
        $this->controller->render('lista_pedidos',array(
			'desde' => $desde,
			'hasta' => $hasta,
			'minimo' => $minimo,
			'maximo' => $maximo,
			'nombre' => $nombre,
			'telefono' => $telefono,
			'dataProvider' => $reporte,
        ));
    }
}


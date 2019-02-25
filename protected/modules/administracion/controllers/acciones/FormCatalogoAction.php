<?php
class FormCatalogoAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}
		else{
			$id = '';
		}
		
		if($id != ""){
			$catalogo = Catalogos::model()->findByPk($id);
		}
		else{
			$catalogo = new Catalogos;
		}
		
		if(isset($_POST['Catalogos'])){
			$catalogo->attributes = $_POST['Catalogos'];
			$catalogo->save();
			$id = $catalogo->id;
			$this->controller->redirect(Yii::app()->createUrl('/administracion/default/formCatalogo/', array('id' => $id)));
		}
		
		if(isset($_GET['producto'])){
			$producto = $_GET['producto'];
		}
		else{
			$producto = '';
		}
		
		if(isset($_GET['accion'])){
			$accion = $_GET['accion'];
		}
		else{
			$accion = '';
		}
		
		if(isset($_GET['despues'])){
			$despues = $_GET['despues'];
		}
		else{
			$despues = '';
		}
	
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
			$estado = 1;
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
		
		if($producto != ''){
			$this->aplicar($id, $producto, $accion, $despues);
			unset($_GET['producto']);
		}
		
		$criteria = new CDbCriteria;
		$criteria->compare('id_catalogo', $id);
		$criteria->order = 'posicion ASC';
		$productos_catalogo_ids = ProductosCatalogo::model()->findAll($criteria); 
		$productos_catalogo =  new CActiveDataProvider(new ProductosCatalogo, array('criteria' => $criteria));
		
		$ids = array();
		foreach($productos_catalogo_ids as $i){
			$ids[] = $i['id_producto'];
		}
		
	
		$criteria = new CDbCriteria;
		$criteria->addCondition('precio_producto >= ' . $min . ' AND precio_producto <= ' . $max);
		$criteria->addCondition('nombre_producto LIKE "%'. $nombre . '%"');
		$criteria->addNotInCondition('id', $ids);
		$criteria->compare('estado_producto', $estado);
		$criteria->compare('id_tipo_producto', $tipo);
		$criteria->compare('id_linea_producto', $linea);
		
		$reporte = new CActiveDataProvider(new Productos, array('criteria' => $criteria));
		
		$tipos = CHtml::listData(TiposProducto::model()->findAll(), 'id', 'nombre_tipo_producto');
		$tipos[""] = 'Todas los tipos';
		ksort($tipos);
		
		$lineas = CHtml::listData(LineasProducto::model()->findAll(), 'id', 'nombre_linea_producto');
		$lineas[""] = 'Todas las lineas';
		ksort($lineas);
		
		

        $this->controller->render('formulario_catalogos',array(
			'nombre' => $nombre,
			'minimo' => $minimo,
			'maximo' => $maximo,
			'estado' => $estado,
			'tipo' => $tipo,
			'linea' => $linea,
			'errores' => $errores,
			'id' => $id,
			'producto' => $producto,
			'catalogo' => $catalogo,
			'dataProvider' => $reporte,
			'productos_catalogo' => $productos_catalogo,
			'tipos' => $tipos,
			'lineas' => $lineas,
        ));
    }
	
	public function aplicar($id_catalogo, $id_producto, $accion, $despues = null){
		switch($accion){
			case 'up':
				$this->up($id_catalogo, $id_producto);
				break;
			case 'down':
				$this->down($id_catalogo, $id_producto);
				break;	
			case 'delete':
				$this->deleteProducto($id_catalogo, $id_producto);
				break;	
			case 'add':
				$this->addProducto($id_catalogo, $id_producto, $despues);
				break;
		}
	}
	
	public function up($id_catalogo, $id_producto){
		$actual = ProductosCatalogo::model()->findByPk(array("id_catalogo" => $id_catalogo, "id_producto" => $id_producto));
		$posicion = $actual->posicion;
		if($posicion != 1){
			$arriba = ProductosCatalogo::model()->find("posicion = " . ($posicion - 1));
			
			$actual->posicion = $posicion - 1;
			$actual->save();
			
			$arriba->posicion = $posicion;
			$arriba->save();
		}
	}
	
	public function down($id_catalogo, $id_producto){
		$actual = ProductosCatalogo::model()->findByPk(array("id_catalogo" => $id_catalogo, "id_producto" => $id_producto));
		$posicion = $actual->posicion;
		$last = $this->ultimaPosicion($id_catalogo);
		if($posicion != $last){
			$abajo = ProductosCatalogo::model()->find("posicion = " . ($posicion + 1));
			
			$actual->posicion = $posicion + 1;
			$actual->save();
			
			$abajo->posicion = $posicion;
			$abajo->save();
		}
	}
	
	public function deleteProducto($id_catalogo, $id_producto){
		$actual = ProductosCatalogo::model()->findByPk(array("id_catalogo" => $id_catalogo, "id_producto" => $id_producto));
		if($actual != null){
			$posicion = $actual->posicion;
			$actual->delete();
			$com = "UPDATE productos_catalogo SET posicion = posicion - 1 WHERE posicion > " . $posicion . " AND id_catalogo = " . $id_catalogo;
			Yii::app()->tienda->createCommand($com)->execute();
		}
	}
	
	public function addProducto($id_catalogo, $id_producto, $despues){
		$actual = ProductosCatalogo::model()->findByPk(array("id_catalogo" => $id_catalogo, "id_producto" => $id_producto));
		if($actual == null){
			$record = new ProductosCatalogo;
			$record->id_catalogo = $id_catalogo;
			$record->id_producto = $id_producto;
			if($despues == null || $despues == ''){
				$last = $this->ultimaPosicion($id_catalogo);
				$record->posicion = $last + 1;
			}
			else{
				$posicion =  ProductosCatalogo::model()->findByPk($despues)->posicion;
				$com = "UPDATE productos_catalogo SET posicion = posicion + 1 WHERE posicion >= " . $posicion . " AND id_catalogo = " . $id_catalogo;
				Yii::app()->tienda->createCommand($com)->execute();
				$record->posicion = $posicion;
			}
			$record->save();
		}
	}
	
	public function ultimaPosicion($id_catalogo){
		$criteria = new CDbCriteria;
		$criteria->compare('id_catalogo', $id_catalogo);
		$criteria->order = "posicion DESC";
		$last = ProductosCatalogo::model()->find($criteria)->posicion;
		return $last;
	}
}


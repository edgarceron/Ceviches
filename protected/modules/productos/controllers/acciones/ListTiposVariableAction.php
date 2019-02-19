<?php
class ListTiposVariableAction extends CAction
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
		
		
		$model = new TiposVariable;
		$criteria = new CDbCriteria;
		$criteria->addCondition('nombre_tipo_variable LIKE "%'. $nombre . '%"');

		
		$reporte = new CActiveDataProvider($model, array('criteria' => $criteria));
		$errores = "";

        $this->controller->render('lista_tipos_variable',array(
			'nombre' => $nombre,
			'errores' => $errores,
			'dataProvider' => $reporte,
        ));
    }
}


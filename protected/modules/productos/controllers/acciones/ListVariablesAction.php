<?php
class ListVariablesAction extends CAction
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
		
		if(isset($_GET['tipo'])){
			$tipo = $_GET['tipo'];
		}
		else{
			$tipo = '';
		}
		
		$model = new Variables;
		$criteria = new CDbCriteria;
		$criteria->addCondition('descripcion_tipo_variable LIKE "%'. $nombre . '%"');
		if($tipo != '')
			$criteria->compare('id_tipo_variable', $tipo);
		$criteria->order = 'id_tipo_variable DESC';
		
		$tipos_variable = CHtml::listData(TiposVariable::model()->findAll(), 'id', 'nombre_tipo_variable');
		$tipos_variable[""] = "Todos los tipos de variable";
		ksort($tipos_variable);

		
		$reporte = new CActiveDataProvider($model, array('criteria' => $criteria));
		$errores = "";

        $this->controller->render('lista_variables',array(
			'nombre' => $nombre,
			'tipo' => $tipo,
			'errores' => $errores,
			'tipos_variable' => $tipos_variable,
			'dataProvider' => $reporte,
        ));
    }
}


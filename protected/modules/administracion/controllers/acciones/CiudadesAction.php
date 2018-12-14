<?php
class CiudadesAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {       
		$model = new Ciudades;
		if(isset($_POST['Ciudades'])){
			$model->attributes=$_POST['Ciudades'];
			$model->save();
		}

		$criteria = new CDbCriteria;
		$reporte = new CActiveDataProvider($model, array('criteria' => $criteria));
		
        $this->controller->render('lista_ciudades',array(
			'model' => $model,
			'dataProvider' => $reporte,
        ));
    }
}


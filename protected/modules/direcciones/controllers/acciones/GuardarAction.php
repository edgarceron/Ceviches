<?php
class GuardarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {               
		$datos = Ciudades::model()->findAll();
		$ciudades = CHtml::listData($datos, 'id', 'nombre_ciudad');
		//Carga del modelo
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$model = Direcciones::model()->findByPk($id); 
			$icono = '/images/edit64.png';
			$parametros_get = '?id='.$id;
			$texto_boton = 'Guardar';
		}
		else{
			$model = new Direcciones;
			$icono = '/images/new64.png';
			$parametros_get = '';
			$texto_boton = 'Crear';
		}
		
		//Añadiendo datos al modelo
		$model->attributes=$_POST['Direcciones'];
		$model->usuario_direccion = Yii::app()->user->id;
		
		//Guardado
		if($model->save()){
			$id = $model['id'];
			$this->controller->redirect(array(
				'/usuarios/default/cuenta', 'id' => Yii::app()->user->id, 'tab' => 2,
			));
		}
		else{
			$this->controller->render('formulario',array(
				'icono' => $icono,
				'texto_boton' => $texto_boton,
				'parametros_get' => $parametros_get,
				'ciudades' => $ciudades,
				'model' => $model,
			));
		}
    }
}
?>


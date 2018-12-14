<?php
class FormularioAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {
		$datos = Ciudades::model()->findAll();
		$ciudades = CHtml::listData($datos, 'id', 'nombre_ciudad');
		if(isset($_GET['id']) && $_GET['id'] != 0){
			$id = $_GET['id'];
			$model = Direcciones::model()->findByPk($id);  
			$texto_boton = 'Guardar';
			$parametros_get = '?id='.$id;
			$icono = '/images/edit64.png';
		}
		else{
			$model = new Direcciones;
			$texto_boton = 'Crear';
			$parametros_get = '';
			$icono = '/images/new64.png';
		}
		
		if(isset($_GET['partial'])){
			$this->controller->renderPartial('_formulario',array(
				'icono' => $icono,
				'texto_boton' => $texto_boton,
				'parametros_get' => $parametros_get,
				'ciudades' => $ciudades,
				'model' => $model,
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


<?php
class VistaAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run($id)
    {                           
        $model = Direcciones::model()->findByPk($id); 
		$ciudad = Ciudades::model()->findByPk($model['ciudad_direccion']);
		$model['ciudad_direccion'] = $ciudad->nombre_ciudad;
		if($model == null){
			throw new CHttpException(404,'No se encuentra la direccion0 especificada, quiza fue borrada antes de ingresar a este sitio.');
		}
		else{
			$errores = '';
			$mensaje = 0;
			
			if(isset($_GET['mensaje'])){
				$mensaje = $_GET['mensaje'];
			}
			
			if($mensaje == 1){
				$errores = '<div class="alert alert-danger" role="alert">El evento no se puede eliminar tiene donaciones asociadas</div>';
			}
			

			$this->controller->render('vista',array(
				'data' => $model,
				'errores' => $errores,
			));
		}
    }
}
?>


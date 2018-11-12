<?php
class FormularioAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$model = Direeciones::model()->findByPk($id);  
			$texto_boton = 'Guardar';
			$parametros_get = '?id='.$id;
			$icono = '/images/edit64.png';
		}
		else{
			$model = new Direeciones;
			$texto_boton = 'Crear';
			$parametros_get = '';
			$icono = '/images/new64.png';
		}
		
        $this->controller->render('formulario',array(
			'icono' => $icono,
			'texto_boton' => $texto_boton,
			'parametros_get' => $parametros_get,
			'model' => $model,
        ));
    }
}
?>


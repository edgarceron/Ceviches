<?php
class GuardarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {               
		
		
		//Añadiendo datos al modelo
		if(isset($_POST['Direcciones'])){
			$datos = Ciudades::model()->findAll();
			$ciudades = CHtml::listData($datos, 'id', 'nombre_ciudad');
			
			//Carga del modelo
			if(isset($_GET['id']) && $_GET['id'] != 0){
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
		else if(isset($_GET['nombre_direccion'])){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				if($id != 0){
					$model = Direcciones::model()->findByPk($id); 
				}
				else{
					$model = new Direcciones;
				}				
			}
			else{
				$model = new Direcciones;
			}
			unset($_GET['id']);
			$model->attributes = $_GET;
			$model->usuario_direccion = Yii::app()->user->id;
			if($model->save()){
				$direcciones_lista = Direcciones::model()->findAll('usuario_direccion = "' . $model->usuario_direccion . '"');
				$direcciones = array();
				foreach($direcciones_lista as $d){
					$str = $d['nombre_direccion'] . ": " . $d['linea1_direccion'] . " " . $d['linea2_direccion'];
					$str = substr($str, 0, 30) . "...";
					$direcciones[] = array('id' => $d['id'], 'direccion'  => $str);
				}
				$retorno = array("mensaje" => 1, "direcciones" => $direcciones, "id" => $model->id);
				echo json_encode($retorno);
			}
			else{
				$retorno = array("mensaje" => 0);
				echo json_encode($retorno);
			}
		}
		else{
			$this->controller->renderText('Ocurrio un error');
		}
    }
}
?>


<?php
class FormAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        if(isset($_GET['id'])){
			$id = $_GET['id']; 
			$producto = Productos::model()->findByPk($id);
			$parametros_get = "/id/" . $producto->id;
			$variables = VariablesProducto::model()->findAll('id_producto = ' . $id);
			$nuevo = false;
		}
		else{
			$producto = new Productos;
			$parametros_get = "";
			$variables = array();
			$nuevo = true;
		}
		$mensaje = '';
		$archivos = new SubirArchivo;
		
		
		if(isset($_POST['Productos'])){
			$producto->attributes = $_POST['Productos'];
			if($producto->save()){
				Yii::app()->user->setFlash('success', "Producto guardado exitosamente, puede proceder a crear las variables");
				$id = $producto->id;
				if(isset($_POST['SubirArchivo'])){
					$archivos->attributes = $_POST['SubirArchivo'];
					
					if(isset($_POST['SubirArchivo']['datos']))
						$archivos->datos=CUploadedFile::getInstance($archivos,'datos');
					if(isset($_POST['SubirArchivo']['datos1']))
						$archivos->datos1=CUploadedFile::getInstance($archivos,'datos1');
					if(isset($_POST['SubirArchivo']['datos2']))
						$archivos->datos2=CUploadedFile::getInstance($archivos,'datos2');
					
					$id = $producto->id;
					$nombre = str_replace(" ","-",utf8_decode($producto->nombre_producto));
					$ruta = './images/productos/'.$id;
					if(!file_exists($ruta))
						mkdir($ruta, 0777, true);
					
					if(isset($archivos->datos)){
						$extension = $archivos->datos->getExtensionName();
						$nombreg = "$nombre"."500px.$extension";
						$archivos->datos->saveAs($ruta."/".$nombreg, false);
						$producto['imageng_producto'] = utf8_encode($nombreg);
					}
					
					if(isset($archivos->datos1)){
						$extension = $archivos->datos1->getExtensionName();
						$nombrem = "$nombre"."300px.$extension";
						$archivos->datos1->saveAs($ruta."/".$nombrem, false);
						$producto['imagenm_producto'] = utf8_encode($nombrem);
					}
					
					if(isset($archivos->datos2)){
						$extension = $archivos->datos2->getExtensionName();
						$nombrep = "$nombre"."70px.$extension";
						$archivos->datos2->saveAs($ruta."/".$nombrep, false);
						$producto['imagenp_producto'] = utf8_encode($nombrep);
					}
					$producto->save();
				}
				if($nuevo){
					$this->controller->redirect(Yii::app()->createUrl('/productos/default/form/', array('id' => $id)));
				}
			}
			else{
				Yii::app()->user->setFlash('warning', "Error al crear el producto, por favor diligencie todos los campos con *");
			}
		}
		
		if(isset($_POST['Afecta'])){
			$naturaleza = $_POST['Afecta'];
			$cuentaReemplaza = 0;
			$ak = array_keys($naturaleza);
			$tiposReemplazados = array();
			foreach($ak as $afecta){
				if($naturaleza[$afecta] == 1){
					$cuentaReemplaza++;
					if($cuentaReemplaza > 1){
						$naturaleza[$afecta] = 0;
						$tiposReemplazados[] = $afecta;
					}
				}
			}
			
			$valores = $_POST['Valor'];
			$ak = array_keys($valores);
			
			$anteriores = VariablesProducto::model()->findAll('id_producto = ' . $id);
			foreach($anteriores as $borrar){
				$borrar->delete();
			}
			
			foreach($ak as $key){
				$variable = Variables::model()->findByPk($key);
				$record = new VariablesProducto;
				$record['id_producto'] = $id;
				$record['id_tipo_variable'] = $variable['id_tipo_variable'];
				$record['id_variable'] = $key;
				$record['afecta_precio'] = $naturaleza[$variable['id_tipo_variable']];
				$record['precio'] = $valores[$key];
				$record->save();
			}
			
		}
		$lineas = CHtml::listData(LineasProducto::model()->findAll(), 'id', 'nombre_linea_producto');
		$tipos =  CHtml::listData(TiposProducto::model()->findAll(), 'id', 'nombre_tipo_producto');
		$tipos_variable = CHtml::listData(TiposVariable::model()->findAll(), 'id', 'nombre_tipo_variable');
		
		if(isset($tiposReemplazados)){
			foreach($tiposReemplazados as $re){
				$mensaje .= " Se cambio el comportamiento de la variable \"" . $tipos_variable[$re] 
				. "\" no pueden haber más de un tipo de variable que reemplace el precio.";
			}
		}

        $this->controller->render('formulario_producto',array(
			'producto' => $producto,
			'archivos' => $archivos,
			'variables' => $variables,
			'parametros_get' => $parametros_get, 
			'lineas' => $lineas,
			'tipos' => $tipos,
			'tipos_variable' => $tipos_variable,
			'mensaje' => $mensaje,
        ));
    }
	
}


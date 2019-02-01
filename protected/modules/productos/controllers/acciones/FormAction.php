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
		}
		else{
			$producto = new Productos;
			$parametros_get = "";
		}
		
		$archivos = new SubirArchivo;
		$variables = array();
		
		if(isset($_POST['Productos'])){
			$producto->attributes = $_POST['Productos'];
			if($producto->save()){
				$id = $producto->id;
				$parametros_get = "/id/" . $id;
				$variables = VariablesProducto::model()->findAll('id_producto = ' . $id);
				if(isset($_POST['SubirArchivo'])){
					$archivos->attributes = $_POST['SubirArchivo'];
					
					if(isset($_POST['SubirArchivo']['datos']))
						$archivos->datos=CUploadedFile::getInstance($archivos,'datos');
					if(isset($_POST['SubirArchivo']['datos1']))
						$archivos->datos1=CUploadedFile::getInstance($archivos,'datos1');
					if(isset($_POST['SubirArchivo']['datos2']))
						$archivos->datos2=CUploadedFile::getInstance($archivos,'datos2');
					
					$id = $producto->id;
					$nombre = str_replace(" ","-",$producto->nombre_producto);
					$ruta = './images/productos/'.$id;
					
					if(isset($archivos->datos)){
						$extension = $archivos->datos->getExtensionName();
						$nombreg = "$nombre"."500px.$extension";
						$archivos->datos->saveAs($ruta."/".$nombreg, false);
						$producto['imageng_producto'] = $nombreg;
					}
					
					if(isset($archivos->datos1)){
						$extension = $archivos->datos1->getExtensionName();
						$nombrem = "$nombre"."300px.$extension";
						$archivos->datos1->saveAs($ruta."/".$nombrem, false);
						$producto['imagenm_producto'] = $nombrem;
					}
					
					if(isset($archivos->datos2)){
						$extension = $archivos->datos2->getExtensionName();
						$nombrep = "$nombre"."70px.$extension";
						$archivos->datos2->saveAs($ruta."/".$nombrep, false);
						$producto['imagenp_producto'] = $nombrep;
					}
					$producto->save();
					
				}
			}
		}
		
		$lineas = CHtml::listData(LineasProducto::model()->findAll(), 'id', 'nombre_linea_producto');
		$tipos =  CHtml::listData(TiposProducto::model()->findAll(), 'id', 'nombre_tipo_producto');
		
		

        $this->controller->render('formulario_producto',array(
			'producto' => $producto,
			'archivos' => $archivos,
			'variables' => $variables,
			'parametros_get' => $parametros_get, 
			'lineas' => $lineas,
			'tipos' => $tipos,
        ));
    }
}


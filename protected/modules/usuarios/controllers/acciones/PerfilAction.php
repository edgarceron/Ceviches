<?php
class PerfilAction extends CAction
{
    public function run()
    {
  
		if(isset($_POST['Perfil']))
		{
			$cvalper = new CDbCriteria();
			$cvalper->compare('nombre', $_POST['Perfil']['nombre']);
			$vali_perfil = Perfil::model()->find($cvalper);
			if(empty($vali_perfil))
			{  
				$perfil_nuevo = new Perfil;
				$perfil_nuevo->nombre = $_POST['Perfil']['nombre'];
				$perfil_nuevo->descripcion = $_POST['Perfil']['descripcion'];
				$perfil_nuevo->fecha_creacion = time();
				if($perfil_nuevo->save())
				{                  
					Yii::app()->user->setFlash('success', "Perfil Guardado!");
					$vali_perfil = $perfil_nuevo;	
				}
				else{
					Yii::app()->user->setFlash('success', "Error al crear el perfil");
				}
			}  
		}
		
		if(isset($_POST['Permisos']) && isset($vali_perfil))
		{
			//print_r($vali_perfil);
			PerfilContenido::model()->deleteAll('perfil = '.$vali_perfil->id);
	  
			foreach($_POST['Permisos'] as $key=>$value)
			{
				$modulo = explode('-', $key);
				$nuevo_permiso = new PerfilContenido;
				$nuevo_permiso->modulo = $modulo[0];
				$nuevo_permiso->controlador = $modulo[0];
				$nuevo_permiso->accion = $modulo[1];
				$nuevo_permiso->estado = 1;
				$nuevo_permiso->perfil = $vali_perfil->id;
				$nuevo_permiso->fecha_creacion = time();
				$nuevo_permiso->save();                    
			}
			//$perfil_nuevo = new Perfil;
			 
		}
       
        $this->controller->redirect('index');
    }
}
?>


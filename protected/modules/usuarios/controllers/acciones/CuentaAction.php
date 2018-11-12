<?php
class CuentaAction extends CAction
{
    public function run($id)
    {
        $usuario = Usuarios::getUsuario($id);  
                
		if(isset($_POST['SofintUsers']))
		{
			$usuario->setAttributes($_POST['SofintUsers']);                                        
			if($usuario->save())
			{
				Yii::app()->user->setFlash('success', "Usuario Actualizado!");
			}   
			else
			{
				Yii::app()->user->setFlash('warning', "Informacion Incompleta, verifique nuevamente!");
			}
		}
		
		$criteria = new CDbCriteria;
		$criteria->compare('usuario_direccion', $id);
		$model = new Direcciones;
		$direcciones = new CActiveDataProvider($model, array('criteria' => $criteria));
                
		$this->controller->render('cuenta',array
		(
			'model'=>$usuario, 
			'direcciones' => $direcciones,
		));
    }
}
?>


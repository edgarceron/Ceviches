<?php
class CuentaAction extends CAction
{
    public function run($id)
    {
        $usuario = Usuarios::getUsuario($id);
		
		if(isset($_GET['tab'])){
			$tab = $_GET['tab'];
		}
		else{
			$tab = 1;
		}
		
		$class_actualizar = '';
		$class_direcciones = '';
		$class_pedidos = '';
		
		if($tab == 1){
			$class_actualizar .= ' active';
		}
		else if($tab == 2){
			$class_direcciones .= ' active';
		} 
		else if($tab == 3){
			$class_pedidos .= ' active';
		} 
		
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
		
		$criteria = new CDbCriteria;
		$criteria->compare('id_usuario_pedido', $id);
		$model = new Pedidos;
		$pedidos = new CActiveDataProvider($model, array('criteria' => $criteria));
                
		$this->controller->render('cuenta',array
		(
			'model'=>$usuario, 
			'direcciones' => $direcciones,
			'pedidos' => $pedidos,
			'class_actualizar' => $class_actualizar,
			'class_direcciones' => $class_direcciones,
			'class_pedidos' => $class_pedidos,
		));
    }
}
?>


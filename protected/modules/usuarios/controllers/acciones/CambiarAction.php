<?php
class CambiarAction extends CAction
{
    public function run($id)
    {
		$app_user_id = Yii::app()->user->id;
		
		if($app_user_id == $id){
			$model = Usuarios::model()->findByPk($id);
			$parametros = array('id' => $id);
			
			if(isset($_POST['oldp']) && isset($_POST['np']) && isset($_POST['confirmation'])){
				$oldpassword = $_POST['oldp'];
				$password = $_POST['np'];
				$confirmation = $_POST['confirmation'];
				if($this->verificarActual($oldpassword, $model)){
					if($this->verificarNueva($password, $confirmation)){
						$model->password = md5($password);
						$model->save();
						Yii::app()->user->setFlash('success', "La contraseña se cambio satisfactoriamente");
						$this->controller->redirect(Yii::app()->createAbsoluteUrl('usuarios/default/view', array('id' => $id)));
					}
				}
				Yii::app()->user->setFlash('success', "Verifique los datos ingresados e intente nuevamente");
			}
			$this->controller->render('cambiarcontra', array('parametros' => $parametros));
		}
		else{
			$this->controller->redirect(Yii::app()->createAbsoluteUrl('usuarios/default/cambiar', array('id' => $app_user_id)));
		}
	}

	public function verificarActual($password, $model){
		$actual = $model->password;
		if($actual == md5($password)){
			return true;
		}
		return false;
	}
	
	public function verificarNueva($password, $confirmation){
		if($password == $confirmation){
			return true;
		}
		else{
			return false;
		}
	}	
}
?>

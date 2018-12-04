<?php
class EliminarCuentaAction extends CAction
{
    public function run($id)
    {
		$id_app_user = Yii::app()->user->id;
		if($id == $id_app_user){
			Yii::app()->user->logout();
			$model = Usuarios::deleteUsuario($id);
			$this->controller->renderText('<div class="alert alert-success" role="alert">Su usuario se elimino exitosamente</div>');
		}
        else{
			$this->controller->renderText('<div class="alert alert-danger" role="alert">Ocurrio un error</div>');
		}
    }
}

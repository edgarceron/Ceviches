<?php
class RestablecerAction extends CAction
{
    public function run($id)
    {
        $usuario = Usuarios::getUsuario($id);
		$clave_temporal = rand(1000, 9999);
		$usuario->password = md5($clave_temporal);
		$usuario->restablecer = 1;
		$usuario->save();
		$nick = $usuario->nick;
		Yii::app()->user->setFlash('warning', "La contraseña del usuario $nick sera $clave_temporal y tendra que cambiar su contraseña al iniciar sesion");
		
		   
		$this->controller->redirect(Yii::app()->createAbsoluteUrl('/usuarios'));
    }
}
?>


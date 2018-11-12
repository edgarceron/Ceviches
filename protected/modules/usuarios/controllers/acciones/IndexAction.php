<?php
class IndexAction extends CAction
{
    public function run()
    {
		
        $model = new Usuarios;
        $perfil = new Perfil;
		$grupo = new Grupo;
		
		
		if(isset($_POST['Usuarios']))
        {
            $model->setAttributes($_POST['Usuarios']);
			$password = $model->password;
            $model->password = md5($_POST['Usuarios']['password']);
            $model->fecha_creacion = time();
            if($model->save())
            {
                Yii::app()->user->setFlash('success', "Usuario Guardado!");
            }   
            else
            {
                Yii::app()->user->setFlash('warning', "Informacion Incompleta, verifique nuevamente!");
				$model->password = $password;
            }
        } 
		
		$usuarios = Usuarios::getUsuarios();  
		$perfiles = Perfil::model()->findAll();
		$grupos = Grupo::model()->findAll();
		
        $this->controller->render('index',array
            (
                'usuarios'=>$usuarios,
                'model'=>$model,
                'perfil'=>$perfil,
                'perfiles'=>$perfiles,
				'grupo'=>$grupo,
				'grupos'=>$grupos,
            ));
    }
}
?>

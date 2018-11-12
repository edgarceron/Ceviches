<?php
class ViewAction extends CAction
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
                
		$this->controller->render('view',array
                    (
                        'usuario'=>$usuario,                         
                    ));
    }
}
?>


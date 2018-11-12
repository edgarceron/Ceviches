<?php
class BorrarAction extends CAction
{
    public function run($id)
    {
        $model = Usuarios::deleteUsuario($id);
        $this->controller->redirect(Yii::app()->createUrl('/usuarios/default/index'));
    }
}
?>

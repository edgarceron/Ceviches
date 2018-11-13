<?php
class EliminarAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $id = $_GET['id'];
		$direccion = Direcciones::model()->findByPk($id);
		$direccion->delete();
		Yii::app()->user->setFlash('success', "Se ha borrado existosamente la dirección");
		$this->controller->redirect(Yii::app()->createUrl("usuarios/default/cuenta/id/". Yii::app()->user->id) . "/tab/2");
    }
}
?>


<?php
class FormCodigoAction extends CAction
{
	public $record;
	
    public function run()
    {                     
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$this->record = CodigosPromocionales::model()->findByPk($id);
			$parametros_get = array("id" => $id);
		}
		else{
			$this->record = new CodigosPromocionales;
			$parametros_get = array();
		}
		
		if(isset($_POST['CodigosPromocionales'])){
			$this->record->attributes=$_POST['CodigosPromocionales'];
			$this->record->codigo = trim($this->record->codigo);
			if($this->record->tipo == 1){
				$this->record->scenario = "porcentaje";
			}
			
			if($this->record->save()){
				Yii::app()->user->setFlash('success', "Codigo creado exitosamente");
				$id = $this->record->id;
				$this->controller->redirect(Yii::app()->createUrl('/administracion/default/formCodigo/', array('id' => $id)));
			}
		}
		
		$tipos_variable = CHtml::listData(TiposVariable::model()->findAll(), 'id', 'nombre_tipo_variable');
		//Se quitan errores de id que pudieron se consecuencia del escenario error
		$this->record->clearErrors('id');
		$this->controller->render('formulario_codigos',array(
			'model' => $this->record, 'parametros_get' => $parametros_get,
			'tipos' => CodigosPromocionales::getTipos(),
		));
    }
}



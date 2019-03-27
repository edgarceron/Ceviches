<?php
class FormVariableAction extends CAction
{
	public $record;
	
    public function run()
    {                     
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$this->record = Variables::model()->findByPk($id);
			$parametros_get = '?id=' . $id;
		}
		else{
			$this->record = new Variables;
			$parametros_get = '';
		}
		$tipos_variable = CHtml::listData(TiposVariable::model()->findAll(), 'id', 'nombre_tipo_variable');
		
		if(isset($_POST['Variables'])){
			$this->record->attributes=$_POST['Variables'];
			$this->calculoDeErrores();
			
			if($this->record->save()){
				Yii::app()->user->setFlash('success', "Variable creada correctamente");
				
				$this->controller->redirect(Yii::app()->createUrl("productos/default/formVariable", array("id"=>$this->record->id)));
			}
		}
		
		
		//Se quitan errores de id que pudieron se consecuencia del escenario error
		$this->record->clearErrors('id');
		$this->controller->render('formulario_variable',array(
			'model' => $this->record, 'parametros_get' => $parametros_get,
			'tipos_variable' => $tipos_variable,
		));
    }
	
	public function calculoDeErrores(){
		$errores = false;
		
		//Calculo de erroes
		/* Se usa para validar errores a los que yii no tiene respuesta, los errores se 
		 * aplican a un attibuto en concreto mediante la funcion addError() ver más en:
		 * https://www.yiiframework.com/doc/api/1.1/CModel#addErrors-detail
		 */
		
		//Fin del calculo de errores
		
		if($errores){
			/* Aplico el escenario error el cual obligara al recordo a fallar su validación
			 * en el campo id.
			 */
			$this->record->scenario = 'error';
		}
	}
}



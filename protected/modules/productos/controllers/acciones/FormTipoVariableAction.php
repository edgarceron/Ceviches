<?php
class FormTipoVariableAction extends CAction
{
	public $record;
	
    public function run()
    {                     
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$this->record = TiposVariable::model()->findByPk($id);
			$parametros_get = '?id=' . $id;
		}
		else{
			$this->record = new TiposVariable;
			$parametros_get = '';
		}
		
		if(isset($_POST['TiposVariable'])){
			$this->record->attributes=$_POST['TiposVariable'];
			$this->calculoDeErrores();
			
			if($this->record->save()){
				Yii::app()->user->setFlash('success', "Tipo de variable creado correctamente");
				$this->controller->redirect(Yii::app()->createUrl("productos/default/formTipoVariable", array("id"=>$this->record->id)));
			}
		}
		
		//Se quitan errores de id que pudieron se consecuencia del escenario error
		$this->record->clearErrors('id');
		$this->controller->render('formulario_tipo_variable',array(
			'model' => $this->record, 'parametros_get' => $parametros_get,
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

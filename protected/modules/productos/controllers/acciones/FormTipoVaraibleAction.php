<?php
class FormTipoVariableAction extends CAction
{
	public $record;
	
    public function run()
    {                     
		if(isset($_GET['id']){
			$id = $_GET['id'];
			$this->record = Model::record()->findByPk($id);
			$parametros_get = '?id=' . $id;
		}
		else{
			$this->record = new Model;
			$parametros_get = '';
		}
		
		if(isset($_POST['Model']){
			$this->record->attributes=$_POST['Model'];
			$this->calculoDeErrores();
			
			if($this->record->save()){
				$this->controller->render('vista',array(
					'record' => $record,
				));
			}
		}
		
		//Se quitan errores de id que pudieron se consecuencia del escenario error
		$this->record->clearErrors('id');
		$this->controller->render('formulario',array(
			'record' => $record, 'parametros_get' = $parametros_get,
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
		
		if($erroes){
			/* Aplico el escenario error el cual obligara al recordo a fallar su validación
			 * en el campo id.
			 */
			$this->record->scenario = 'error';
		}
	}
}



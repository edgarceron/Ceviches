<?php
class FormTipoProductoAction extends CAction
{
	public $record;
	
    public function run()
    {                     
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$this->record = TiposProducto::model()->findByPk($id);
			$parametros_get = '?id=' . $id;
		}
		else{
			$this->record = new TiposProducto;
			$parametros_get = '';
		}
		
		if(isset($_POST['TiposProducto'])){
			$this->record->attributes=$_POST['TiposProducto'];
			$this->calculoDeErrores();
			
			if($this->record->save()){
				$id = $this->record->id;
				$this->controller->redirect(Yii::app()->createUrl('productos/default/formTipoProducto',  array('id' => $id)));
			}
		}
		
		//Se quitan errores de id que pudieron se consecuencia del escenario error
		$this->record->clearErrors('id');
		$this->controller->render('formulario_tipo',array(
			'model' => $this->record, 'parametros_get' => $parametros_get,
		));
		
    }
	
	public function calculoDeErrores(){
		$errores = false;
		
		//Calculo de erroes
		/* Se usa para validar errores a los que yii no tiene respuesta, los errores se 
		 * aplican a un attibuto en concreto mediante la funcion addError() ver más en:
		 * https://www.yiiframework.com/doc/api/1.1/CTiposProducto#addErrors-detail
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
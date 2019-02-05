<?php
class AddTipoVariableAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $id_tipo_variable = $_GET['tipo'];
		$id_producto = $_GET['producto'];
		
		$tipo = TiposVariable::model()->findByPk($id_tipo_variable);
		$variables = CHtml::listData(Variables::model()->findAll('id_tipo_variable = ' . $id_tipo_variable), 'id', 'descripcion_tipo_variable');
		
		$criteria = new CDbCriteria;
		$criteria->compare('id_producto', $id_producto);
		$criteria->compare('id_tipo_variable', $id_tipo_variable);
		
		$variables_producto = VariablesProducto::model()->findAll($criteria);

        $this->controller->renderPartial('_form_tipo_variable',array(
			'tipo' => $tipo,
			'variables' => $variables,
			'variables_producto' => $variables_producto,
        ));
    }
}


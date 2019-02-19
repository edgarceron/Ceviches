<?php
/* @var $this LineasProductoController */
/* @var $model LineasProducto */
/* @var $form CActiveForm */
?>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
			Formulario de producto
		</div>
		
		<div class="card-body">

			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'lineas-producto-formulario_linea-form',
				'action'=> Yii::app()->createAbsoluteUrl('/productos/default/formVariable') . $parametros_get ,
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>
				<div class="row">

					<?php echo $form->errorSummary($model); ?>

					<div class="form-group col-lg-6">
						<?php echo $form->labelEx($model,'id_tipo_variable',array('class'=>'label label-success')); ?>
						<?php echo $form->dropDownList($model,'id_tipo_variable', $tipos_variable,array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'id_tipo_variable'); ?>
					</div>
					<div class="form-group col-lg-6">
						<?php echo $form->labelEx($model,'descripcion_tipo_variable',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($model,'descripcion_tipo_variable',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'descripcion_tipo_variable'); ?>
					</div>
					<div class="form-group col-lg-12">
						<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-primary')); ?>
					</div>
				</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>

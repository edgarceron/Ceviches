<?php
/* @var $this TiposProductoController */
/* @var $model TiposProducto */
/* @var $form CActiveForm */
?>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
			Formulario de tipo de producto
		</div>
		
		<div class="card-body">

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'tipos-producto-formulario_tipo-form',
			'action'=> Yii::app()->createAbsoluteUrl('/productos/default/formTipoProducto') . $parametros_get,
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// See class documentation of CActiveForm for details on this,
			// you need to use the performAjaxValidation()-method described there.
			'enableAjaxValidation'=>false,
		)); ?>

			<?php echo $form->errorSummary($model); ?>

			<div class="form-group col-lg-6">
				<?php echo $form->labelEx($model,'nombre_tipo_producto',array('class'=>'label label-success')); ?>
				<?php echo $form->textField($model,'nombre_tipo_producto',array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'nombre_tipo_producto'); ?>
			</div>
			<div class="form-group col-lg-12">
				<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-primary')); ?>
			</div>
		<?php $this->endWidget(); ?>

		</div><!-- form -->
	</div>
</div>
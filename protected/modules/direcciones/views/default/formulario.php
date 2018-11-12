<?php
/* @var $this DireccionesController */
/* @var $model Direcciones */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'direcciones-form',
	'action'=>Yii::app()->createAbsoluteUrl('/direcciones/default/guardar'.$parametros_get),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre_direccion'); ?>
		<?php echo $form->textField($model,'nombre_direccion',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'nombre_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ciudad'); ?>
		<?php echo $form->textField($model,'ciudad'); ?>
		<?php echo $form->error($model,'ciudad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'linea1_direccion'); ?>
		<?php echo $form->textField($model,'linea1_direccion',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'linea1_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'linea2_direccion'); ?>
		<?php echo $form->textField($model,'linea2_direccion',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'linea2_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono_direccion'); ?>
		<?php echo $form->textField($model,'telefono_direccion',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'telefono_direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'usuario_direccion'); ?>
		<?php echo $form->textField($model,'usuario_direccion'); ?>
		<?php echo $form->error($model,'usuario_direccion'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
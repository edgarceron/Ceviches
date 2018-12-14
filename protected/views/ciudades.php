<?php
/* @var $this CiudadesController */
/* @var $model Ciudades */
/* @var $form CActiveForm */
?>

<div class="row">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ciudades-ciudades-form',
        'action'=>/* Yii::app()->createAbsoluteUrl('/module/default/set') */,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="col-lg-4">
	<div class="form-group">
		<?php echo $form->labelEx($model,'nombre_ciudad',array('class'=>'label label-success')); ?>
		<?php echo $form->textField($model,'nombre_ciudad',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'nombre_ciudad'); ?>
	</div>
    </div>
    <div class="col-lg-12">
	<div class="form-group">
		<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary')); ?>
	</div>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
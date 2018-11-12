<?php
/* @var $this SofintUsersController */
/* @var $model SofintUsers */
/* @var $form CActiveForm */
?>

<div class="col-lg-12">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sofint-users-_form-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>	
    <br/>
	<?php echo $form->errorSummary($model); ?>

    <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'nick',array('class'=>'label label-success')); ?>
		<?php echo $form->textField($model,'nick',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'nick'); ?>
	</div>
    </div>
    <?php if($model->isNewRecord){ ?>
    <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'password',array('class'=>'label label-success')); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
    </div>
    <?php } ?>
   <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'nombre',array('class'=>'label label-success')); ?>
		<?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>
    </div>
    <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'apellido',array('class'=>'label label-success')); ?>
		<?php echo $form->textField($model,'apellido',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>
    </div>
	
	<div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'fecha_nacimiento',array('class'=>'label label-success')); ?>
		<?php echo $form->dateField($model,'fecha_nacimiento',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'fecha_nacimiento'); ?>
	</div>
    </div>
   
    
    <div class="col-lg-12">
	<div class="form-group">
		<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary')); ?>
	</div>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
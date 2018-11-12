<?php
/* @var $this SofintUsersController */
/* @var $grupo SofintUsers */
/* @var $form CActiveForm */
?>

<div class="col-lg-12">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sofint-users-_form-form',
	'action'=>Yii::app()->createUrl('/usuarios/default/grupo'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>	
    <br/>
	<?php echo $form->errorSummary($grupo); ?>

    <div class="col-lg-6">
		<div class="form-group">
			<?php echo $form->labelEx($grupo,'nombre',array('class'=>'label label-success')); ?>
			<?php echo $form->textField($grupo,'nombre',array('class'=>'form-control')); ?>
			<?php echo $form->error($grupo,'nombre'); ?>
		</div>   
    </div>
   
    
    <div class="col-lg-12">
		<div class="form-group">
			<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary')); ?>
		</div>
    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
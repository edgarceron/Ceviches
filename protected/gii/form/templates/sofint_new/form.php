<?php
/**
 * This is the template for generating a form script file.
 * The following variables are available in this template:
 * - $this: the FormCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getModelClass(); ?>Controller */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>

<div class="row">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass).'-'.basename($this->viewName)."-form',
        'action'=>/* Yii::app()->createAbsoluteUrl('/module/default/set') */,
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php foreach($this->getModelAttributes() as $attribute): ?>
    <div class="col-lg-4">
	<div class="form-group">
		<?php echo "<?php echo \$form->labelEx(\$model,'$attribute',array('class'=>'label label-success')); ?>\n"; ?>
		<?php echo "<?php echo \$form->textField(\$model,'$attribute',array('class'=>'form-control')); ?>\n"; ?>
		<?php echo "<?php echo \$form->error(\$model,'$attribute'); ?>\n"; ?>
	</div>
    </div>
<?php endforeach; ?>
    <div class="col-lg-12">
	<div class="form-group">
		<?php echo "<?php echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary')); ?>\n"; ?>
	</div>
    </div>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->
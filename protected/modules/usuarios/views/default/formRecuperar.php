<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
        $this->module->nombre,
);
?>



<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/lock.png' ?>"/>
		</div>
		
		<div class="card-body">
			  
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eventos-eventos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/usuarios/default/recuperar'),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>

				<div class="col-sm-4">
					<div class="form-group">
						<?php echo CHtml::label('Nombre de usuario','nick',array('class'=>'label label-success')); ?>
						<?php echo CHtml::textField('nick', '', array('class'=>'form-control')); ?>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo CHtml::label('Correo electronico','email',array('class'=>'label label-success')); ?>
						<?php echo CHtml::textField('email', '', array('class'=>'form-control')); ?>
					</div>
				</div>
				
				<div class="col-sm-12">
				<div class="form-group">
					<?php echo CHtml::submitButton('Recuperar contraseña',array('class'=>'btn btn-primary')); ?>
				</div>
				</div>
			<?php $this->endWidget(); ?>

		</div>
	</div>
</div>

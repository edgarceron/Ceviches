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
			 Ingrese su contraseña anterior, la nueva contraseña que desea usar y la confirmación de la misma: 
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eventos-eventos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/usuarios/default/cambiar', $parametros),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo CHtml::label('Contraseña anterior','oldp',array('class'=>'label label-success')); ?>
						<?php echo CHtml::passwordField('oldp', '', array('class'=>'form-control')); ?>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo CHtml::label('Nueva contraseña','np',array('class'=>'label label-success')); ?>
						<?php echo CHtml::passwordField('np', '', array('class'=>'form-control')); ?>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<?php echo CHtml::label('Confirmar contraseña','confirmation',array('class'=>'label label-success')); ?>
						<?php echo CHtml::passwordField('confirmation', '', array('class'=>'form-control')); ?>
					</div>
				</div>
				
				<div class="col-sm-12">
				<div class="form-group">
					<?php echo CHtml::submitButton('Cambiar contraseña',array('class'=>'btn btn-primary')); ?>
				</div>
				</div>
			<?php $this->endWidget(); ?>

		</div>
	</div>
</div>

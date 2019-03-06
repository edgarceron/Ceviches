<?php
/* @var $this CodigosPromocionalesController */
/* @var $model CodigosPromocionales */
/* @var $form CActiveForm */
?>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<h3><img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
			Datos del catalogo</h3>
		</div>
		<div class="card-body">

			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'codigos-promocionales-formulario_codigos-form',
				'action'=> Yii::app()->createAbsoluteUrl('/administracion/default/formCodigo'),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>

				<p class="note">Fields with <span class="required">*</span> are required.</p>

				<?php echo $form->errorSummary($model); ?>
				<div class="row">
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($model,'codigo',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($model,'codigo',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'codigo'); ?>
					</div>
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($model,'tipo',array('class'=>'label label-success')); ?>
						<?php echo $form->dropDownList($model,'tipo',$tipos,array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'tipo'); ?>
					</div>
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($model,'valor',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($model,'valor',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'valor'); ?>
					</div>
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($model,'valido_desde',array('class'=>'label label-success')); ?>
						<?php echo $form->dateField($model,'valido_desde',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'valido_desde'); ?>
					</div>
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($model,'valido_hasta',array('class'=>'label label-success')); ?>
						<?php echo $form->dateField($model,'valido_hasta',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'valido_hasta'); ?>
					</div>
					<div class="form-group col-lg-12">
						<?php echo $form->labelEx($model,'mensaje',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($model,'mensaje',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'mensaje'); ?>
					</div>
					<div class="form-group col-lg-12">
						<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-primary')); ?>
					</div>
				</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div><!-- form --><br>
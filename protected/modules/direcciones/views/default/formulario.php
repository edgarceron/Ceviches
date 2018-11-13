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

	<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'nombre_direccion'); ?>
		<?php echo $form->textField($model,'nombre_direccion',array('class'=>'form-control','maxlength'=>30, 'id' => 'nombre_direccion')); ?>
		<?php echo $form->error($model,'nombre_direccion'); ?>
		

		<div class="btn-group" role="group" aria-label="Basic example">
		  <button type="button" class="btn btn-secondary" onclick="nombreDireccion('Casa')">Casa</button>
		  <button type="button" class="btn btn-secondary" onclick="nombreDireccion('Oficina')">Oficina</button>
		  <button type="button" class="btn btn-secondary" onclick="nombreDireccion('Casa de mi novi@')">Casa de mi novi@</button>
		</div>
	</div>

	<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'ciudad_direccion'); ?>
		<?php echo $form->dropDownList($model,'ciudad_direccion', $ciudades,array('class'=>'form-control', 'id' => 'ciudad_direccion')); ?>
		<?php echo $form->error($model,'ciudad_direccion'); ?>
	</div>

	<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'linea1_direccion'); ?>
		<?php echo $form->textField($model,'linea1_direccion',array('class'=>'form-control','maxlength'=>100)); ?>
		<?php echo $form->error($model,'linea1_direccion'); ?>
	</div>

	<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'linea2_direccion'); ?>
		<?php echo $form->textField($model,'linea2_direccion',array('class'=>'form-control','maxlength'=>100)); ?>
		<?php echo $form->error($model,'linea2_direccion'); ?>
	</div>

	<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'telefono_direccion'); ?>
		<?php echo $form->textField($model,'telefono_direccion',array('class'=>'form-control','maxlength'=>20)); ?>
		<?php echo $form->error($model,'telefono_direccion'); ?>
	</div>

	<div class="col-lg-12">
		<div class="form-group">
			<?php echo CHtml::submitButton($texto_boton,array('class'=>'btn btn-primary')); ?>
		</div>
    </div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<script>
	function nombreDireccion(nombre){
		document.getElementById("nombre_direccion").value =  nombre;
	}
</script>
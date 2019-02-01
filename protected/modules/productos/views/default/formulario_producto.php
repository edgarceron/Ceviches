<?php
/* @var $this ProductosController */
/* @var $producto Productos */
/* @var $form CActiveForm */
?>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
			Formulario de producto
		</div>
		
		<div class="card-body">

			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'productos-fomulario_productos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/productos/default/form'.$parametros_get),
				'htmlOptions' => array('enctype' => 'multipart/form-data'),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>

				<p class="note">Fields with <span class="required">*</span> are required.</p>

				<?php echo $form->errorSummary($producto); ?>
				<div class="row">
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($producto,'nombre_producto',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($producto,'nombre_producto',array('class'=>'form-control')); ?>
						<?php echo $form->error($producto,'nombre_producto'); ?>
					</div>
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($producto,'precio_producto',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($producto,'precio_producto',array('class'=>'form-control')); ?>
						<?php echo $form->error($producto,'precio_producto'); ?>
					</div>
					<div class="form-group col-lg-12">
						<?php echo $form->labelEx($producto,'descripcion_producto',array('class'=>'label label-success')); ?>
						<?php echo $form->textArea($producto,'descripcion_producto',array('class'=>'form-control')); ?>
						<?php echo $form->error($producto,'descripcion_producto'); ?>
					</div>
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($producto,'calorias_producto',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($producto,'calorias_producto',array('class'=>'form-control')); ?>
						<?php echo $form->error($producto,'calorias_producto'); ?>
					</div>
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($producto,'id_tipo_producto',array('class'=>'label label-success')); ?>
						<?php echo $form->dropDownList($producto,'id_tipo_producto', $tipos,array('class'=>'form-control')); ?>
						<?php echo $form->error($producto,'id_tipo_producto'); ?>
					</div>
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($producto,'id_linea_producto',array('class'=>'label label-success')); ?>
						<?php echo $form->dropDownList($producto,'id_linea_producto', $lineas, array('class'=>'form-control')); ?>
						<?php echo $form->error($producto,'id_linea_producto'); ?>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($archivos,'datos',array('class'=>'label label-success')); ?>
						<?php echo $form->fileField($archivos,'datos',array('class'=>'')); ?>
						<?php echo $form->error($archivos,'datos'); ?>
					</div>
					<div class="form-group col-lg-12">
						<?php
							if(isset($producto['id']) && $producto['imageng_producto'] != ''){
								echo CHtml::image(Yii::app()->request->baseUrl.'/images/productos/'.$producto['id'].'/'.$producto['imageng_producto']); 
							}
						?>
					</div>
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($archivos,'datos1',array('class'=>'label label-success')); ?>
						<?php echo $form->fileField($archivos,'datos1',array('class'=>'')); ?>
						<?php echo $form->error($archivos,'datos1'); ?>
					</div>
					<div class="form-group col-lg-12">
						<?php
							if(isset($producto['id']) && $producto['imagenm_producto'] != ''){
								echo CHtml::image(Yii::app()->request->baseUrl.'/images/productos/'.$producto['id'].'/'.$producto['imagenm_producto']); 
							}
						?>
					</div>
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($archivos,'datos2',array('class'=>'label label-success')); ?>
						<?php echo $form->fileField($archivos,'datos2',array('class'=>'')); ?>
						<?php echo $form->error($archivos,'datos2'); ?>
					</div>
					<div class="form-group col-lg-12">
						<?php
							if(isset($producto['id']) && $producto['imagenp_producto'] != ''){
								echo CHtml::image(Yii::app()->request->baseUrl.'/images/productos/'.$producto['id'].'/'.$producto['imagenp_producto']); 
							}
						?>
					</div>
					<div class="form-group col-lg-12">
						<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-primary')); ?>
					</div>
				</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>
<br>
<?php if(isset($producto['id'])){ ?>
<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
			Variables del producto
		</div>
		
		<div class="card-body">

			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'productos-fomulario_productos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/productos/default/form'.$parametros_get),
				'htmlOptions' => array('enctype' => 'multipart/form-data'),
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>

				<p class="note">Fields with <span class="required">*</span> are required.</p>

				<?php echo $form->errorSummary($producto); ?>
				<div class="row" id="variables_div">
					<div class="form-group col-lg-4">
						<?php echo CHtml::button('Añadir variable',array('class'=>'btn btn-primary', "onclick" => "crearVariable()")); ?>
					</div>
				</div>
				
				<script>
					var variables = <?php echo count($variables) ?>;
					function crearVariable(){
						
					}
				</script>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>
<br>
<?php } ?>
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
					<div class="form-group col-lg-4">
						<?php echo $form->labelEx($producto,'estado_producto',array('class'=>'label label-success')); ?>
						<?php echo $form->dropDownList($producto,'estado_producto', array(1 => 'Activo', 0 => 'Inactivo'),array('class'=>'form-control')); ?>
						<?php echo $form->error($producto,'estado_producto'); ?>
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
						<?php echo CHtml::submitButton('Guardar datos del producto',array('class'=>'btn btn-primary')); ?>
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

				<?php if($mensaje != ""){
					?>
					<div class="alert alert-danger" role="alert"><?php echo $mensaje ?></div>
					<?php
				} ?>
				<div class="row" id="variables_div">
					<div class="form-group col-lg-6">
						<?php 
							$tipos_variable_disponibles = $tipos_variable;
							foreach($variables as $v){
								if(isset($tipos_variable_disponibles[$v['id_tipo_variable']])){
									unset($tipos_variable_disponibles[$v['id_tipo_variable']]);
								}
							}
							echo CHtml::dropDownList('Tipo variable', '', $tipos_variable_disponibles, array('class' => 'form-control', 'id' => 'tipo_variable')); 
						?>
					</div>
					<div class="form-group col-lg-6">
						<?php echo CHtml::button('Añadir variable',array('class'=>'btn btn-primary', "onclick" => "crearVariable()")); ?>
					</div>
				</div>
				
				<div class="row">
					<div class="form-group col-lg-12">
						<?php echo CHtml::submitButton('Guardar variables del producto',array('class'=>'btn btn-primary')); ?>
					</div>
				</div>
				<script>
					var variablesTipo;
					var variables = <?php echo count($variables) ?>;
					function htmlTipoVariable(tipo){
						$("#tipo_variable option:selected").remove();
						var producto = <?php echo $producto['id'] ?>;
						
						jQuery.ajax({
							'type':'GET',
							'dataType':'html',
							'async':false,
							'url':'<?php echo Yii::app()->createAbsoluteUrl('/productos/default/addTipoVariable') ?>',
							'cache':false,
							'data':{'tipo': tipo, 'producto': producto},
							'success':function(html){
								jQuery("#variables_div").append(html);
							}
						});		
					}
					
					function crearVariable(){
						var tipo = $('#tipo_variable').val();
						htmlTipoVariable(tipo);
					}
					
					function eliminarVariable(variable, tipo){
						var div = "#variable" + variable;
						var div_obj = $(div);
						
						var lab = "#label" + variable;
						var text = $(lab).text();
						
						div_obj.remove();
						
						sel = "#variables_select" + tipo;
						sel_obj = $(sel);
						
						sel_obj.append(new Option(text, variable));
						
						var bot = '#botones' + tipo + '_div';
						$(bot).css("display", "block");
					}
					
					function nuevoValorTipoVariable(tipo){
						var div = '#tipovariable' + tipo + '_div';
						var sel = '#variables_select' + tipo;
						var div_obj = $(div);
						var sel_obj = $(sel);
						var text = $(sel + " option:selected").text();
						var value = sel_obj.val();
						div_obj.append('<div class="row" id="variable' + value + '">'
						+'<div class="form-group col-md-3"><label class="form-control" id="label'+value+'">' + text + '</label></div>'
						+'<div class="form-group col-md-3"><input class="form-control" type="text" value="0" name="Valor[' + value + ']" id="Valor_' + value + '"></div>'
						+'<div class="form-group col-md-3"><input class="btn btn-primary" onclick="eliminarVariable('+ value +' , '+ tipo +')" type="button" value="Eliminar variable"></div>' 
						+'</div>');
						
						$(sel + " option:selected").remove();
						var var_disponibles = $(sel + " option").size();
						if(var_disponibles == 0){
							var bot = '#botones' + tipo + '_div';
							$(bot).css("display", "none");
						}
					}
					
					$( document ).ready(function() {
						<?php 
							$tv = array();
							foreach($variables as $var){
								$tv[$var['id_tipo_variable']] = $var['id_tipo_variable'];
							}
							foreach($tv as $t){
								echo "htmlTipoVariable($t);";
							}
						?>
					});
				</script>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>
<br>
<?php } ?>
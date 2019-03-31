<?php
/* @var $this DireccionesController */
/* @var $model Direcciones */
/* @var $form CActiveForm */
?>
	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>
	<div class="form-row">
		<div class="form-group col-md-9">
			<?php echo CHtml::activeLabelEx($model,'nombre_direccion'); ?>
			<?php echo CHtml::activeTextField($model,'nombre_direccion',array('class'=>'form-control','maxlength'=>30, 'id' => 'nombre_direccion')); ?>
			<?php echo CHtml::error($model,'nombre_direccion'); ?>
			

			<div class="btn-group" role="group" id="btn-group-nombre" aria-label="Basic example">
			  <button type="button" class="btn btn-secondary" onclick="nombreDireccion('Casa')">Casa</button>
			  <button type="button" class="btn btn-secondary" onclick="nombreDireccion('Oficina')">Oficina</button>
			  <button type="button" class="btn btn-secondary" onclick="nombreDireccion('Casa de mi novi@')">Casa de mi novi@</button>
			</div>
		</div>

		<div class="form-group col-md-3">
			<?php echo CHtml::activeLabelEx($model,'ciudad_direccion'); ?>
			<?php echo CHtml::activeDropDownList($model,'ciudad_direccion', $ciudades,array('class'=>'form-control', 'id' => 'ciudad_direccion')); ?>
			<?php echo CHtml::error($model,'ciudad_direccion'); ?>
		</div>
	</div>
	
	<div class="form-row">
		<div class="form-group col-md-12">
			<?php echo CHtml::activeLabelEx($model,'linea1_direccion'); ?>
			<?php echo CHtml::activeTextField($model,'linea1_direccion',array('class'=>'form-control','maxlength'=>100, 'id' => 'linea1_direccion')); ?>
			<?php echo CHtml::error($model,'linea1_direccion'); ?>
		</div>
	</div>
	
	<div class="form-row">
		<div class="form-group col-md-12">
			<?php echo CHtml::activeLabelEx($model,'linea2_direccion'); ?>
			<?php echo CHtml::activeTextField($model,'linea2_direccion',array('class'=>'form-control','maxlength'=>100, 'id' => 'linea2_direccion')); ?>
			<?php echo CHtml::error($model,'linea2_direccion'); ?>
		</div>
	</div>
	
	<div class="form-row">
		<div class="form-group col-md-12">
			<?php echo CHtml::activeLabelEx($model,'telefono_direccion'); ?>
			<?php echo CHtml::activeTextField($model,'telefono_direccion',array('class'=>'form-control','maxlength'=>20, 'id' => 'telefono_direccion')); ?>
			<?php echo CHtml::error($model,'telefono_direccion'); ?>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-12">
			<?php echo CHtml::button($texto_boton,array('class'=>'btn btn-primary', 'onclick' => 'guardarDireccion()', 'id' => 'btn-crear')); ?>
			<?php echo CHtml::button('Editar',array('class'=>'btn btn-primary', 'onclick' => 'editarDireccion()', 'id' => 'btn-editar')); ?>
			<?php echo CHtml::label('', '',array('id' => 'label_mensaje')); ?>
		</div>
	</div>


<script>
	var id = 0;
	<?php if($model['id'] != null) echo 'id='.$model['id'] . ";" ?>
	function guardarDireccion(){
		var nombre_direccion = $('#nombre_direccion').val();
		var ciudad_direccion = $('#ciudad_direccion').val();
		var linea1_direccion = $('#linea1_direccion').val();
		var linea2_direccion = $('#linea2_direccion').val();
		var telefono_direccion = $('#telefono_direccion').val();
		
		$.get(
			'<?php echo Yii::app()->createAbsoluteUrl('/direcciones/default/guardar') ?>', 
			{
				nombre_direccion: nombre_direccion, 
				ciudad_direccion: ciudad_direccion,
				linea1_direccion: linea1_direccion,
				linea2_direccion: linea2_direccion,
				telefono_direccion: telefono_direccion,
				id: id,
			}, 
			function(r) {
				//alert(r);
				var respuesta = JSON.parse(r);
				if(respuesta['mensaje'] == 1){
					$('#label_mensaje').text('Guardado con exito');
					var direcciones = respuesta['direcciones'];
					var key = 0;
					$('#direccion').empty();
					var d;
					for(d in direcciones){
						key = direcciones[d].id;
						$('#direccion').append('<option value=' + key + '>'+ direcciones[d].direccion + '</option>');
					}
					$('#direccion').val(respuesta['id']);
					id = respuesta['id'];
					$("#btn-finalizar").prop("disabled", false);
				}
			}
		);
		
		inhabilitarFormulario();
	}
	
	function editarDireccion(){
		$('#btn-editar').hide();
		$("#btn-finalizar").prop("disabled", true);
		habilitarFormulario();
	}
	
	function inhabilitarFormulario(){
		$('#btn-crear').hide();
		$('#btn-group-nombre').hide();
		$('#nombre_direccion').attr('readonly', true);
		$('#ciudad_direccion').attr('readonly', true);
		$('#linea1_direccion').attr('readonly', true);
		$('#linea2_direccion').attr('readonly', true);
		$('#telefono_direccion').attr('readonly', true);
	}
	
	function habilitarFormulario(){
		$('#btn-crear').show();
		$('#btn-group-nombre').show();
		$('#nombre_direccion').attr('readonly', false);
		$('#ciudad_direccion').attr('readonly', false);
		$('#linea1_direccion').attr('readonly', false);
		$('#linea2_direccion').attr('readonly', false);
		$('#telefono_direccion').attr('readonly', false);
	}
	
	<?php 
	if(!$model->isNewRecord){
	?>
	inhabilitarFormulario();
	<?php
	}
	else{
	?>
	$('#btn-editar').hide();
	<?php	
	}
	?>
</script>
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
			<h3><img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
			Datos del catalogo</h3>
		</div>
		<div class="card-body">
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eventos-eventos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/administracion/default/formCatalogo'),
				'method'=>'post',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>
			<div class="row">
				<div class="form-group col-md-6">
					<?php echo $form->labelEx($catalogo,'nombre_catalogo'); ?>
					<?php echo $form->textField($catalogo,'nombre_catalogo', array('class'=>'form-control', 'id' => 'nombre_catalogo')); ?>
					<?php echo $form->error($catalogo,'nombre_catalogo'); ?>
				</div>
				<div class="form-group col-md-6">
					<?php echo $form->labelEx($catalogo,'orden_catalogo'); ?>
					<?php echo $form->dropDownList($catalogo,'orden_catalogo', array(1 => "Por posición", 2 => "Por linea de producto"),array('class'=>'form-control', 'id' => 'orden_catalogo')); ?>
					<?php echo $form->error($catalogo,'orden_catalogo'); ?>
				</div>
				<div class="form-group col-md-3">
					<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-primary form-control')); ?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
		</div>
	</div>
	<br>
	<?php 
	if($id != ''){
	?>
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/list64.png' ?>"/>
			Productos en el catalogo
		</div>
		
		<div class="card-body">
		<?php
			//print_r($dataProvider);
		?>
		<?php
			setlocale(LC_MONETARY, 'es_CO');
			Yii::app()->controller->widget(
				'zii.widgets.grid.CGridView', array(	
					'id'=>'reporte-grid',
					'dataProvider'=>$productos_catalogo,
					'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/bootstrap.min.css'),
					'cssFile' => Yii::app()->baseUrl . '/css/bootstrap.min.css',
					//'data'=>$queue,
					'itemsCssClass' => 'table table-hover table-striped', 
					'pager'=>array(
						"internalPageCssClass" => "page-item",
					),
					'columns'=>array(
						array(
							'name' => 'Imagen',
							'type' => 'raw',
							'value' => 'CHtml::image(
								Yii::app()->request->baseUrl."/images/productos/".$data->id_producto."/".Productos::model()->findByPk($data->id_producto)->imagenp_producto, "No se cargo la imagen",array("class" => "img-thumbnail"))'
						),
						array(
							'name' => 'nombre_producto',
							'type' => 'raw',
							'value' => 'Productos::model()->findByPk($data->id_producto)->nombre_producto'
						),
						array(
							'name' => 'precio_producto',
							'type' => 'raw',
							'value' => 'number_format(Productos::model()->findByPk($data->id_producto)->precio_producto, 0, ",", ".")'
						),
						array
						(
							'class'=>'CButtonColumn',
							'template'=>'{up}{down}{delete}' ,
							'buttons'=>array
							(
								'up' => array
								(
									'label'=>'Editar este producto',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/up.png',
									'url'=>'Yii::app()->createUrl("administracion/default/formCatalogo", 
										array(
											"id" => "' . $id .'",
											"producto"=>$data->id_producto,
											"accion" => "up",
											"nombre" => "' .$nombre .'",
											"minimo" => "' .$minimo .'",
											"maximo" => "' .$maximo .'",
											"estado" => "' .$estado .'",
											"tipo" => "' .$tipo .'",
											"linea" => "' .$linea .'",)
											)',
								),
								'down' => array
								(
									'label'=>'Añadir al catalogo',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/down.png',
									'url'=>'Yii::app()->createUrl("administracion/default/formCatalogo", 
										array(
											"id" => "' . $id .'",
											"producto"=>$data->id_producto,
											"accion" => "down",
											"nombre" => "' .$nombre .'",
											"minimo" => "' .$minimo .'",
											"maximo" => "' .$maximo .'",
											"estado" => "' .$estado .'",
											"tipo" => "' .$tipo .'",
											"linea" => "' .$linea .'",)
											)',
								),
								
								'delete' => array
								(
									'label'=>'Ver el evento',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
									'url'=>'Yii::app()->createUrl("administracion/default/formCatalogo", 
										array(
											"id" => "' . $id .'",
											"producto"=>$data->id_producto,
											"accion" => "delete",
											"nombre" => "' .$nombre .'",
											"minimo" => "' .$minimo .'",
											"maximo" => "' .$maximo .'",
											"estado" => "' .$estado .'",
											"tipo" => "' .$tipo .'",
											"linea" => "' .$linea .'",)
											)',
								),
							),
						)
					),
				)
			);		
		?>
		</div>
	</div>
	<br>
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
		</div>
		
		<div class="card-body">
			  
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eventos-eventos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/administracion/default/formCatalogo', 
						array(
							'id' => $id,
						)),
				'method'=>'get',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>

				<?php echo $errores; ?>
				
				<div class="form-row">
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Nombre', 'nombre'); ?>
						<?php echo CHtml::textField('nombre',$nombre,array('id'=>'nombre', 'class'=>'form-control')); ?>
					</div>	
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Precio desde', 'minimo'); ?>
						<?php echo CHtml::textField('minimo',$minimo,array('id'=>'minimo', 'class'=>'form-control','oninput'=>'formatoMoneda(this)')); ?>
					</div>	
					
					<div class="form-group col-md-4">
						<?php echo CHtml::label('hasta', 'maximo'); ?>
						<?php echo CHtml::textField('maximo',$maximo,array('id'=>'maximo', 'class'=>'form-control', 'oninput'=>'formatoMoneda(this)')); ?>
					</div>		
				</div>

				<div class="form-row">
					<div class="form-group col-md-3">
						<?php echo CHtml::label('Estado', 'estado'); ?>
						<?php echo CHtml::dropDownList('estado',$estado,array(1 => 'Activo', 0 => 'Inactivo') ,array('id'=>'estado', 'class'=>'form-control')); ?>
					</div>	
					<div class="form-group col-md-3">
						<?php echo CHtml::label('Tipo de producto', 'tipo'); ?>
						<?php echo CHtml::dropDownList('tipo',$tipo,$tipos ,array('id'=>'tipo', 'class'=>'form-control')); ?>
					</div>
					<div class="form-group col-md-3">
						<?php echo CHtml::label('Linea del producto', 'linea'); ?>
						<?php echo CHtml::dropDownList('linea',$linea,$lineas ,array('id'=>'linea', 'class'=>'form-control')); ?>
					</div>
				</div>	
				
				
				
				<div class="form-row">
					<div class="form-group col-md-3">
						<?php echo CHtml::submitButton('Filtrar',array('class'=>'btn btn-primary form-control')); ?>
					</div>
					<div class="form-group col-md-3">
						<?php echo CHtml::button('Limpiar', array('class' => 'btn btn-primary form-control', 'onclick' => 'limpiarCampos()')) ?>
					</div>
				</div>
			<?php $this->endWidget(); ?>

		</div>
	</div>
	<br>
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/list64.png' ?>"/>
		</div>
		
		<div class="card-body">
		<?php
			//print_r($dataProvider);
		?>
		<?php
			setlocale(LC_MONETARY, 'es_CO');
			Yii::app()->controller->widget(
				'zii.widgets.grid.CGridView', array(	
					'id'=>'reporte-grid',
					'dataProvider'=>$dataProvider,
					'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/bootstrap.min.css'),
					'cssFile' => Yii::app()->baseUrl . '/css/bootstrap.min.css',
					//'data'=>$queue,
					'itemsCssClass' => 'table table-hover table-striped', 
					'pager'=>array(
						"internalPageCssClass" => "page-item",
					),
					'columns'=>array(
						array(
							'name' => 'Imagen',
							'type' => 'raw',
							'value' => 'CHtml::image(Yii::app()->request->baseUrl."/images/productos/".$data->id."/".$data->imagenp_producto, "No se cargo la imagen",array("class" => "img-thumbnail"))'
						),
						'nombre_producto',	
						array(
							'name' => 'precio_producto',
							'type' => 'raw',
							'value' => 'number_format($data->precio_producto, 0, ",", ".")'
						),
						
						array
						(
							'class'=>'CButtonColumn',
							'template'=>'{edit}{add}' ,
							'buttons'=>array
							(
								'edit' => array
								(
									'label'=>'Editar este producto',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
									'url'=>'Yii::app()->createUrl("productos/default/form", array("id"=>$data->id))',
								),
								'add' => array
								(
									'label'=>'Añadir al catalogo',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/add.png',
									'url'=>'Yii::app()->createUrl("administracion/default/formCatalogo", 
										array(
											"id" => "' . $id .'",
											"producto"=>$data->id,
											"accion" => "add",
											"nombre" => "' .$nombre .'",
											"minimo" => "' .$minimo .'",
											"maximo" => "' .$maximo .'",
											"estado" => "' .$estado .'",
											"tipo" => "' .$tipo .'",
											"linea" => "' .$linea .'",)
											)',
								),
								/*
								'delete' => array
								(
									'label'=>'Ver el evento',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
									'url'=>'Yii::app()->createUrl("donaciones/default/eliminar", 
										array("id"=>$data->id, "lugar" => "reporte", 
										"evento" => "'. $evento .'",
										"donante" => "'. $donante .'",
										"minimo" => "'. $minimo .'",
										"maximo" => "'. $maximo .'",
										))',
								),*/
							),
						)
						
					),
				)
			);			
		?>
		</div>
	</div>
	<br>
	<?php
	}
	?>
	<script type="text/javascript">
		function limpiarCampos(){
			document.getElementById("nombre").value = "";
			document.getElementById("linea").value = "";
			document.getElementById("tipo").value = "";
			document.getElementById("minimo").value = "";
			document.getElementById("maximo").value = "";
			document.getElementById("estado").value = 1;
		}
	</script>
</div>
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
			Productos
		</div>
		
		<div class="card-body">
			  
			<div class="card-body">
				<table class="table">
					<tr>
						<td><?php echo CHtml::button('Crear nuevo producto', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/productos/default/form/') . '"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Lista de productos', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/productos/default/list/') . '"', 'class' => 'btn btn-secondary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Crear nueva linea de producto', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/productos/default/formLineaProducto/') . '"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Lista de lineas de producto', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/productos/default/listLineasProducto/') . '"', 'class' => 'btn btn-secondary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Crear nuevo tipo de producto', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/productos/default/formTipoProducto/') . '"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Lista de tipos de producto', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/productos/default/listTiposProducto/') . '"', 'class' => 'btn btn-secondary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Crear nuevo tipo de variable', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/productos/default/formTipoVariable/') . '"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Lista de tipos de variable', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/productos/default/listTiposVariable/') . '"', 'class' => 'btn btn-secondary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Crear nueva variable', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/productos/default/formVariable/') . '"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Lista de variables', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/productos/default/listVariables/') . '"', 'class' => 'btn btn-secondary form-control')); ?></th>
					</tr>
				</table>
			</div>

		</div>
	</div>
</div>

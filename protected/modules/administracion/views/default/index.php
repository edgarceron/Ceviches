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
			Administración
		</div>
		
		<div class="card-body">
			  
			<div class="card-body">
				<table class="table">
					<tr>
						<td><?php echo CHtml::button('Administrar Ciudades', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/administracion/default/ciudades/') . '"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Lista de pedidos', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/administracion/default/pedidos/') . '"', 'class' => 'btn btn-secondary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('Ver clientes', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/administracion/default/reporteUsuarios/') . '"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
				</table>
			</div>

		</div>
	</div>
</div>

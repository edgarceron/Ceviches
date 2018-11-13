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
				<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/view64.png' ?>"/>
			</div>
			<div class="card-body">
				<?php echo $errores; ?>
				<table class="table">
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('nombre_direccion') ?></th>
						<td><?php echo $data->nombre_direccion ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('ciudad_direccion') ?></th>
						<td><?php echo $data->ciudad_direccion ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('linea1_direccion') ?></th>
						<td><?php echo $data->linea1_direccion ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('linea2_direccion') ?></th>
						<td><?php echo $data->linea2_direccion ?></th>
					</tr>
					<tr>
						<th scope="row"><?php echo $data->getAttributeLabel('telefono_direccion') ?></th>
						<td><?php echo $data->telefono_direccion ?></th>
					</tr>
				</table>
				<?php echo CHtml::button('Editar', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/direcciones/default/formulario/id/' . $data->id .'"', 'class' => 'btn btn-primary')); ?>
				<?php echo CHtml::button('Eliminar', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/direcciones/default/eliminar/id/' . $data->id .'"', 'class' => 'btn btn-primary')); ?>
				<?php echo CHtml::button('Volver a la lista de direcciones', array('onclick' => 'js:document.location.href="'. Yii::app()->request->baseUrl . '/index.php/usuarios/default/cuenta/id/' . Yii::app()->user->id . '/tab/2"', 'class' => 'btn btn-primary')); ?>
			</div>
		</div>
	</div>

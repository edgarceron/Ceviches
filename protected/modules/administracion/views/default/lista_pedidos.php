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
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/edit64.png' ?>"/>
		</div>
		
		<div class="card-body">
			  
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'eventos-eventos-form',
				'action'=>Yii::app()->createAbsoluteUrl('/administracion/default/pedidos'),
				'method'=>'get',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>


				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Nombre cliente', 'nombre'); ?>
						<?php echo CHtml::textField('nombre',$nombre,array('id'=>'nombre', 'class'=>'form-control')); ?>
					</div>	
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Telefono cliente', 'telefono'); ?>
						<?php echo CHtml::textField('telefono',$telefono,array('id'=>'telefono', 'class'=>'form-control')); ?>
					</div>	
				</div>	 
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Valor pedido desde', 'minimo'); ?>
						<?php echo CHtml::textField('minimo',$minimo,array('id'=>'minimo', 'class'=>'form-control')); ?>
					</div>	
					
					<div class="form-group col-md-6">
						<?php echo CHtml::label('hasta', 'maximo'); ?>
						<?php echo CHtml::textField('maximo',$maximo,array('id'=>'maximo', 'class'=>'form-control')); ?>
					</div>	
				</div>	
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Fecha desde', 'desde'); ?>
						<?php echo CHtml::dateField('desde',$desde,array('id'=>'desde', 'class'=>'form-control')); ?>
					</div>	
					
					<div class="form-group col-md-6">
						<?php echo CHtml::label('hasta', 'hasta'); ?>
						<?php echo CHtml::dateField('hasta',$hasta,array('id'=>'hasta', 'class'=>'form-control')); ?>
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
							'name' => 'id_usuario_pedido',
							'type' => 'raw',
							'value' => 'SofintUsers::model()->findByPk($data->id_usuario_pedido)->nombre . " ". SofintUsers::model()->findByPk($data->id_usuario_pedido)->apellido',
						),
						'fecha_pedido',
						'estado_pedido',
						'direccion_pedido',
						'medio_pago_pedido',
						array
						(
							'class'=>'CButtonColumn',
							'template'=>'{view}' /* . '{delete}' */,
							'buttons'=>array
							(
								'view' => array
								(
									'label'=>'Ver el pedido',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
									'url'=>'Yii::app()->createUrl("administracion/default/verPedido", array("id_pedido"=>$data->id))',
								),
							),
						)
						
					),
				)
			);			
		?>
		</div>
	</div>
</div>

<script type="text/javascript">

	
	
	function limpiarCampos(){
		document.getElementById("telefono").value = "";
		document.getElementById("nombre").value = "";
		document.getElementById("minimo").value = "";
		document.getElementById("maximo").value = "";
		document.getElementById("desde").valueAsDate = null;
		document.getElementById("hasta").valueAsDate = null;
	}
</script>
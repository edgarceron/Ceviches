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
				'action'=>Yii::app()->createAbsoluteUrl('/administracion/default/listCodigos'),
				'method'=>'get',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>


				
				<div class="form-row">
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Código', 'codigo'); ?>
						<?php echo CHtml::textField('codigo',$codigo,array('id'=>'codigo', 'class'=>'form-control')); ?>
					</div>	
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Tipo de descuento', 'tipo'); ?>
						<?php echo CHtml::dropDownList('tipo',$tipo, $tipos, array('id'=>'tipo', 'class'=>'form-control')); ?>
					</div>	
				</div>	 
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Valor codigo desde', 'minimo'); ?>
						<?php echo CHtml::textField('minimo',$minimo,array('id'=>'minimo', 'class'=>'form-control')); ?>
					</div>	
					
					<div class="form-group col-md-6">
						<?php echo CHtml::label('hasta', 'maximo'); ?>
						<?php echo CHtml::textField('maximo',$maximo,array('id'=>'maximo', 'class'=>'form-control')); ?>
					</div>	
				</div>	
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Fecha de validez', 'validez'); ?>
						<?php echo CHtml::dateField('validez',$validez,array('id'=>'validez', 'class'=>'form-control')); ?>
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
						'codigo',
						array(
							'name' => 'tipo',
							'type' => 'raw',
							'value' => 'CodigosPromocionales::getTipos()[$data->tipo]',
						),
						'valor',
						'valido_desde',
						'valido_hasta',
						array
						(
							'class'=>'CButtonColumn',
							'template'=>'{edit}' /* . '{delete}' */,
							'buttons'=>array
							(
								'edit' => array
								(
									'label'=>'Editar el código',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
									'url'=>'Yii::app()->createUrl("administracion/default/formCodigo", array("id"=>$data->id))',
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
		document.getElementById("codigo").value = "";
		document.getElementById("tipo").value = "";
		document.getElementById("minimo").value = "";
		document.getElementById("maximo").value = "";
		document.getElementById("validez").valueAsDate = null;
	}
</script>
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
				'action'=>Yii::app()->createAbsoluteUrl('/administracion/default/reporteUsuarios'),
				'method'=>'get',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>

				
				<div class="form-row">
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Mes fecha de cumpleaños', 'mes'); ?>
						<?php echo CHtml::dropDownList('mes',$mes,$meses, array('id'=>'mes', 'class'=>'form-control')); ?>
					</div>	
					
					<div class="form-group col-md-4">
						<?php echo CHtml::label('Ciudad', 'ciudad'); ?>
						<?php echo CHtml::dropDownList('ciudad',$ciudad, $ciudades,array('id'=>'ciudad', 'class'=>'form-control')); ?>
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
						'nick',
						'nombre',
						'apellido',
						'fecha_nacimiento',						
					),
				)
			);			
		?>
		</div>
	</div>
	
	<div class="form-group col-md-3">
	<?php
		echo CHtml::link(

			'Descargar csv', 
			Yii::app()->createUrl("/administracion/default/reporteUsuarios", array(
				'ciudad' => $ciudad,
				'mes' => $mes,
				'reporte' => 'csv',
			)), 
			array(
				'submit'=>array('/administracion/default/reporteUsuarios'),
				'class'=>'btn btn-primary form-control'
			)
		);
	?>
	</div>
</div>

<script type="text/javascript">

	
	
	function limpiarCampos(){
		document.getElementById("desde").valueAsDate = null;
		document.getElementById("hasta").valueAsDate = null;
		$('#ciudad').val('');
	}
</script>
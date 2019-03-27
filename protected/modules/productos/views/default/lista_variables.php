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
				'action'=>Yii::app()->createAbsoluteUrl('/productos/default/listVariables'),
				'method'=>'get',
				// Please note: When you enable ajax validation, make sure the corresponding
				// controller action is handling ajax validation correctly.
				// See class documentation of CActiveForm for details on this,
				// you need to use the performAjaxValidation()-method described there.
				'enableAjaxValidation'=>false,
			)); ?>

				<?php echo $errores; ?>
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Nombre', 'nombre'); ?>
						<?php echo CHtml::textField('nombre',$nombre,array('id'=>'nombre', 'class'=>'form-control')); ?>
					</div>	
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<?php echo CHtml::label('Tipo', 'tipo'); ?>
						<?php echo CHtml::dropDownList('tipo',$tipo, $tipos_variable, array('id'=>'nombre', 'class'=>'form-control')); ?>
					</div>	
				</div>

				<div class="form-row">
					<div class="form-group col-md-3">
						<?php echo CHtml::submitButton('Filtrar',array('class'=>'btn btn-primary form-control')); ?>
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
							'name' => 'id_tipo_variable',
							'header' => 'Tipo de variable',
							'type' => 'raw',
							'value' => 'TiposVariable::model()->findByPk($data->id_tipo_variable)["nombre_tipo_variable"]'
						),
						'descripcion_tipo_variable',	
						array
						(
							'class'=>'CButtonColumn',
							'template'=>'{edit}' /* . '{delete}' */,
							'buttons'=>array
							(
								'edit' => array
								(
									'label'=>'Eliminar el producto',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
									'url'=>'Yii::app()->createUrl("productos/default/formVariable", array("id"=>$data->id))',
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
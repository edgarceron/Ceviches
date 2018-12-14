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
			  
			<div class="row">

				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'ciudades-ciudades-form',
						'action'=>Yii::app()->createAbsoluteUrl('/administracion/default/ciudades'),
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// See class documentation of CActiveForm for details on this,
					// you need to use the performAjaxValidation()-method described there.
					'enableAjaxValidation'=>false,
				)); ?>

					<p class="note">Fields with <span class="required">*</span> are required.</p>

					<?php echo $form->errorSummary($model); ?>

				
					<div class="form-group">
						<?php echo $form->labelEx($model,'nombre_ciudad',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($model,'nombre_ciudad',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'nombre_ciudad'); ?>
					</div>
			
					
					<div class="form-group">
						<?php echo CHtml::submitButton('Crear',array('class'=>'btn btn-primary')); ?>
					</div>
					
				<?php $this->endWidget(); ?>

			</div><!-- form -->
		</div>
	</div>
	<br>
	<div class="card">
		<div class="card-header">
			<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/list64.png' ?>"/>
		</div>
		
		<div class="card-body">
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
						'nombre_ciudad',
						/*
						array
						(
							'class'=>'CButtonColumn',
							'template'=>'{delete}' ,
							'buttons'=>array
							(
								'delete' => array
								(
									'label'=>'Ver el pedido',
									'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
									'url'=>'Yii::app()->createUrl("administracion/default/borrarCiudad", array("id"=>$data->id))',
								),
							),
						)
						*/
					),
				)
			);			
		?>
		</div>
	</div>
</div>

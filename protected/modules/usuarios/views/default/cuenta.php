<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
        $this->module->nombre,
);
?>
    <ul class="nav nav-tabs" role="tablist">        
        <li class="nav-item active"><a href="#actualizar" aria-controls="actualizar" role="tab" data-toggle="tab" class="<?php echo 'nav-link ' .$class_actualizar ?>"><span class="glyphicon glyphicon-refresh"></span> Actualizar</a></li>
        <li class="nav-item"><a href="#direcciones" aria-controls="direcciones" role="tab" data-toggle="tab" class="<?php echo 'nav-link ' .$class_direcciones ?>"><span class="glyphicon glyphicon-book"></span> Direcciones</a></li>        
        <li class="nav-item"><a href="#pedidos" aria-controls="pedidos" role="tab" data-toggle="tab" class="<?php echo 'nav-link ' .$class_pedidos ?>"><span class="glyphicon glyphicon-book"></span>Pedidos</a></li>        
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">              
        <div role="tabpanel" class="<?php echo 'tab-pane ' .$class_actualizar ?>" id="actualizar">
			<div class="col-lg-12">

				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'sofint-users-_form-form',
					// Please note: When you enable ajax validation, make sure the corresponding
					// controller action is handling ajax validation correctly.
					// See class documentation of CActiveForm for details on this,
					// you need to use the performAjaxValidation()-method described there.
					'enableAjaxValidation'=>false,
				)); ?>	
					<br/>
					<?php echo $form->errorSummary($model); ?>

					<div class="col-lg-6">
					<div class="form-group">
						<?php echo $form->labelEx($model,'nick',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($model,'nick',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'nick'); ?>
					</div>
					</div>
				   <div class="col-lg-6">
					<div class="form-group">
						<?php echo $form->labelEx($model,'nombre',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($model,'nombre',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'nombre'); ?>
					</div>
					</div>
					<div class="col-lg-6">
					<div class="form-group">
						<?php echo $form->labelEx($model,'apellido',array('class'=>'label label-success')); ?>
						<?php echo $form->textField($model,'apellido',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'apellido'); ?>
					</div>
					</div>
					
					<div class="col-lg-6">
					<div class="form-group">
						<?php echo $form->labelEx($model,'fecha_nacimiento',array('class'=>'label label-success')); ?>
						<?php echo $form->dateField($model,'fecha_nacimiento',array('class'=>'form-control')); ?>
						<?php echo $form->error($model,'fecha_nacimiento'); ?>
					</div>
					</div>
					
					<div class="col-lg-12">
						<div class="form-group">
							<?php echo CHtml::submitButton('Actualizar',array('class'=>'btn btn-primary')); ?>
							<?php 
								$id_app_user = Yii::app()->user->id;
								$id_user = $model['id'];
								if($id_user == $id_app_user){
									echo CHtml::button('Cambiar mi contraseña', array('onclick' => 'js:document.location.href="'. Yii::app()->createAbsoluteUrl('/usuarios/default/cambiar', array('id' => $id_user)) . '"', 'class' => 'btn btn-primary')); 
									echo CHtml::button('Eliminar mi cuenta', array('onclick' => 'js:document.location.href="'. Yii::app()->createAbsoluteUrl('/usuarios/default/eliminarCuenta', array('id' => $id_user)) . '"', 'class' => 'btn btn-primary')); 
								}
							?>
						</div>
					</div>
				<?php $this->endWidget(); ?>

			</div><!-- form -->
        </div>
        <div role="tabpanel" class="<?php echo 'tab-pane ' .$class_direcciones ?>" id="direcciones">			
			<div class="card">
				<div class="card-header">
					<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/list64.png' ?>"/>
				</div>
				
				<div class="card-body  table-responsive">
				
				<?php echo CHtml::button('Crear una nueva dirección', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/direcciones/default/formulario'). '"', 'class' => 'btn btn-primary')); ?>
				<br><br>
					<?php
						Yii::app()->controller->widget(
							'zii.widgets.grid.CGridView', array(	
								'id'=>'reporte-grid',
								'dataProvider'=>$direcciones,
								'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/bootstrap.min.css'),
								'cssFile' => Yii::app()->baseUrl . '/css/bootstrap.min.css',
								//'data'=>$queue,
								'itemsCssClass' => 'table table-hover table-striped',
								'pager'=>array(
									"internalPageCssClass" => "page-item",
								),
								'columns'=>array(
									'nombre_direccion',
									array(
										'name' => 'ciudad_direccion',
										'type' => 'raw',
										'value' => 'Ciudades::model()->findByPk($data->ciudad_direccion)->nombre_ciudad',
									),
									'linea1_direccion',
									'linea2_direccion',
									'telefono_direccion',
									array
									(
										'class'=>'CButtonColumn',
										'template'=>'{view}{edit}{delete}',
										'buttons'=>array
										(
											'view' => array
											(
												'label'=>'Ver direccion',
												'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
												'url'=>'Yii::app()->createUrl("direcciones/default/vista", array("id"=>$data->id))',
											),
											'edit' => array
											(
												'label'=>'Editar direccion',
												'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
												'url'=>'Yii::app()->createUrl("direcciones/default/formulario", array("id"=>$data->id))',
											),
											'delete' => array
											(
												'label'=>'Eliminar direccion',
												'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
												'url'=>'Yii::app()->createUrl("direcciones/default/eliminar", 
													array("id"=>$data->id))',
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

		<div role="tabpanel" class="<?php echo 'tab-pane ' .$class_pedidos ?>" id="pedidos">		
			<div class="card">
				<div class="card-header">
					<img alt="Bootstrap Image Preview" src="<?php echo Yii::app()->request->baseUrl.'/images/list64.png' ?>"/>
				</div>
				
				<div class="card-body table-responsive">
				<?php
					Yii::app()->controller->widget(
						'zii.widgets.grid.CGridView', array(	
							'id'=>'reporte-grid',
							'dataProvider'=>$pedidos,
							'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/bootstrap.min.css'),
							'cssFile' => Yii::app()->baseUrl . '/css/bootstrap.min.css',
							//'data'=>$queue,
							'itemsCssClass' => 'table table-hover table-striped',
							'pager'=>array(
								"internalPageCssClass" => "page-item",
							),
							'columns'=>array(
								'luigi_pedido',
								'fecha_pedido',
								'direccion_pedido',
								'medio_pago_pedido',
								'estado_pedido',
								array
								(
									'class'=>'CButtonColumn',
									'template'=>'{view}',
									'buttons'=>array
									(
										'view' => array
										(
											'label'=>'Ver direccion',
											'imageUrl'=>Yii::app()->request->baseUrl.'/images/view.png',
											'url'=>'Yii::app()->createUrl("tienda/default/verPedido", array("id_pedido"=>$data->id))',
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
    </div>

<div class="col-lg-12">
<?php
/* @var $this SofintUsersController */
/* @var $perfil SofintUsers */
/* @var $form CActiveForm */
$infomodulos = Modulos::model()->findAll();
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-permisos',
        'action'=>Yii::app()->createUrl('/usuarios/default/perfil'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>	
    <br/>
	<?php echo $form->errorSummary($perfil); ?>

    <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($perfil,'nombre',array('class'=>'label label-success')); ?>
		<?php echo $form->textField($perfil,'nombre',array('class'=>'form-control')); ?>
		<?php echo $form->error($perfil,'nombre'); ?>
	</div>
    </div>
   
    <div class="col-lg-6">
	<div class="form-group">
		<?php echo $form->labelEx($perfil,'descripcion',array('class'=>'label label-success')); ?>
		<?php echo $form->textArea($perfil,'descripcion',array('class'=>'form-control')); ?>
		<?php echo $form->error($perfil,'descripcion'); ?>
	</div>
    </div>
   
    
    

<!-- form -->
</div>
<div class="col-lg-12">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Plugin</th>                    
                <th>Accion</th>
               
            </tr>
        </thead>
        <?php if($perfil->isNewRecord){ ?>        
        <tbody>   
            <?php foreach ($infomodulos as $infomodulo) { ?>
            <tr class="bg-primary">
                <th><?php echo $infomodulo->nombre ?></th>
                <td><div class="col-lg-6"><?php echo CHtml::checkBox('Permisos['.$infomodulo->nombre.'-'.$infomodulo->nombre.']',"",array('data'=>$infomodulo->nombre)) ?><span class="glyphicon glyphicon-refresh"></span></div></td>
            </tr> 
                <?php 
                    $infoacciones = Acciones::model()->findAll('modulo = "'.$infomodulo->nombre.'"');
                foreach($infoacciones as $infoaccion){ ?>
                <tr class="alert-info">
                    <td><?php echo $infoaccion->accion ?></td>
                    <td><div class="col-lg-6"><?php echo CHtml::checkBox('Permisos['.$infomodulo->nombre.'-'.$infoaccion->accion.']',"",array('data'=>$infoaccion->accion)) ?><span class="glyphicon glyphicon-refresh"></span></div></td>
                </tr>
                <?php } ?>
            <?php } ?>            
        </tbody>
        <?php } else { ?>
        <tbody>   
            <?php foreach ($infomodulos as $infomodulo) { ?>
            <?php
                $checked = false;
                $p1 = PerfilContenido::model()->find('modulo = "'.$infomodulo->nombre.'" and accion = "'.$infomodulo->nombre.'" and perfil = '.$perfil->id);
                if(!empty($p1))
                {
                    $checked = true;
                }
            ?>
            <tr class="bg-success">
                <th><?php echo $infomodulo->nombre ?></th>
                <td><div class="col-lg-6"><?php echo CHtml::checkBox('Permisos['.$infomodulo->nombre.'-'.$infomodulo->nombre.']',$checked,array('data'=>$infomodulo->nombre)) ?><span class="glyphicon glyphicon-refresh"></span></div></td>
            </tr> 
                <?php 
                    $infoacciones = Acciones::model()->findAll('modulo = "'.$infomodulo->nombre.'"');
                foreach($infoacciones as $infoaccion){ ?>
                 <?php
                    $checked = false;
                    $p2 = PerfilContenido::model()->find('modulo = "'.$infomodulo->nombre.'" and accion = "'.$infoaccion->accion.'" and perfil = '.$perfil->id);
                    
                    if(count($p2) == 1)
                    {
                        $checked = true;
                    }
                ?>
                <tr class="bg-warning">
                    <td><?php echo $infoaccion->accion ?></td>
                    <td><div class="col-lg-6"><?php echo CHtml::checkBox('Permisos['.$infomodulo->nombre.'-'.$infoaccion->accion.']',$checked) ?><span class="glyphicon glyphicon-refresh"></span></div></td>
                </tr>
                <?php } ?>
            <?php } ?>            
        </tbody>
        <?php } ?>
    </table>
</div>
 

<div class="col-lg-12">
	<div class="form-group">
		<?php echo CHtml::submitButton('Guardar',array('class'=>'btn btn-primary')); ?>
	</div>
    </div>
<?php $this->endWidget(); ?>
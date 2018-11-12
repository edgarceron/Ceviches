<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
        $this->module->nombre,
);

Yii::app()->clientScript->registerScript('addplugin', "
    
    $( '.checkbox-column' ).on( 'click', function() {
    var urlup = '". Yii::app()->createUrl('/plugins/default/registrarplugin') ."';
	var urldown = '". Yii::app()->createUrl('/plugins/default/unregistrarplugin') ."';
    if( $(this).is(':checked') ){        
        var plugin = $(this).attr('name');
        $.ajax({
                method: 'POST',
                url: urlup,
                data: { plugin: plugin, valor: 1 }
              })
                .done(function( msg ) {                    
                    console.log('plugin activado');
                });
    } else {
        var plugin = $(this).attr('name');
        $.ajax({
                method: 'POST',
                url: urlup,
                data: { plugin: plugin, valor: 0 }
              })
                .done(function( msg ) {                    
                    console.log('plugin desactivado');
                });
    }
});
");

?>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Plugin</th>
            <th>Nombre</th>
            <th>Ruta</th>            
            <th>Version</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach(array_keys(Yii::app()->modules) as $modulos){ ?>
        <?php if($modulos != "gii"){ ?>
        <?php 
                $valor_check = false;
                $check = Modulos::model()->findByPk($modulos); 
                if(!empty($check))
                {
                    if($check->estado == 1)
                    {
                        $valor_check = true;
                    }                    
                }
        ?>
        <tr>             
            <td><?php echo $modulos ?></td>
            <td><?php echo Yii::app()->getModule($modulos)->nombre ?></td>
            <td><?php echo (Yii::app()->getModule($modulos)->padre != '') ? Yii::app()->getModule($modulos)->padre.'->'.$modulos:$modulos;  ?></td>            
            <td><?php echo Yii::app()->getModule($modulos)->version ?></td>
            <td> 
                <?php if(Yii::app()->getModule($modulos)->version != 0) { ?>
                <?php echo CHtml::CheckBox($modulos,$valor_check, array ('class'=>'checkbox-column',)); ?>
                <?php } ?>
            </td>
        </tr>
        <?php } } ?>
    </tbody>
</table>
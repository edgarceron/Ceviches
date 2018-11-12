<?php echo "<?php\n"; ?>
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
        $this->module->nombre,
);
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <div class="container row">
            <div class="col-lg-6 text-left"><img alt="Bootstrap Image Preview" src="<?php echo "<?php"; ?> echo Yii::app()->request->baseUrl.'/images/icon.png' ?>"/></div>
            <div class="col-lg-6"></div>
        </div>
      
    </div>
    <div class="panel-body">
      <div class="col-lg-12 container">
          
          <?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(	
	'id'=>'Model-grid',//Reemplazar Model por el modelo que corresponda
	'dataProvider'=>$modelview->search(),
	'pager' => array('cssFile' => Yii::app()->baseUrl . '/css/bootstrap.min.css'),
	'cssFile' => Yii::app()->baseUrl . '/css/bootstrap.min.css',
        'itemsCssClass' => 'table table-hover table-striped',
	'columns'=>array(
            //Agregar las columnas que desea visualizar            
            array
            (
                'class'=>'CButtonColumn',
                //'cssClassExpression'=>'$data->estado_pedido==0 ? "danger" : "" ',
                'template'=>'{borrar}{editar}',
                'buttons'=>array
                (
                    'borrar' => array
                    (
                        'label'=>'Delete Element',
                        'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                        //'options'=>array('class'=>'detalles'),
                        'url'=>'Yii::app()->createUrl("model/default/quit", array("item"=>$data->ID))',//reemplazar module por el modulo que estan trabajando
                    ),
                    'editar' => array
                    (
                        'label'=>'Edit Element',
                        'imageUrl'=>Yii::app()->request->baseUrl.'/images/edit.png',
                        //'options'=>array('data-toggle'=>'modal', 'data-target'=>'#exampleModal'),
                        'url'=>'Yii::app()->createUrl("model/default/index", array("item"=>$data->ID))',//reemplazar module por el modulo que estan trabajando
                    ),
                    
                ),
            ),
        ),
)); ?>
          
        
    
    
    
    
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="container row">
            <div class="col-lg-6 text-left"><img alt="Bootstrap Image Preview" src="<?php echo "<?php"; ?> echo Yii::app()->request->baseUrl.'/images/data.png' ?>"/></div>
            <div class="col-lg-6"></div>
        </div>
      
    </div>
    <div class="panel-body">
        <div class="col-lg-12 container">
    
        
        <?php echo "<?php"; ?> echo $this->renderPartial('_form', array('model'=>$model)) ?>
    
    
    
        </div>
    </div>
</div>

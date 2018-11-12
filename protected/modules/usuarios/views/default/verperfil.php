<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
        $this->module->nombre,
);
?>
<?php echo $this->renderPartial('_perfil', array('perfil'=>$perfil)); ?>

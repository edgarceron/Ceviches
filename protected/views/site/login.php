<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p>Por favor ingrese sus credenciales para iniciar sensión:</p>
<?php
 if(isset($_GET['mensaje'])){
	$mensaje =  $_GET['mensaje'];
	if($mensaje == 1){
		echo '<div class="alert alert-success" role="alert">La contraseña se cambio satisfactoriamente, por favor ingrese con sus nueva contraseña</div>';
	}
 }
?>


<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


	<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group col-md-6">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="form-group col-md-6 rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary')); ?>
		<?php echo CHtml::button('Olvide mi contraseña', array('onclick' => 'js:document.location.href="'. Yii::app()->createAbsoluteUrl('/usuarios/default/recuperar') . '"', 'class' => 'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

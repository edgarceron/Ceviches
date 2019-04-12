	  
<div class="container">
		<div class="row"><?php echo CHtml::button('Ya tengo cuenta y deseo iniciar sesión', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/site/login') . '"', 'class' => 'btn btn-primary btn-block')); ?></div>
		<br>
		<div class="row"><?php echo CHtml::button('No tengo cuenta y deseo registrarme', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/site/register') . '"', 'class' => 'btn btn-secondary btn-block')); ?></div>
</div>
<br>
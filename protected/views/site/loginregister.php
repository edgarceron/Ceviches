<div class="col-sm-12">
	<div class="card">
		<div class="card-header">
			Por favor seleccione una de las siguientes opciones.
		</div>
		
		<div class="card-body">		  
			<div class="card-body">
				<table class="table">
					<tr>
						<td><?php echo CHtml::button('Ya tengo cuenta y deseo iniciar sesión', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/site/login') . '"', 'class' => 'btn btn-primary form-control')); ?></th>
					</tr>
					<tr>
						<td><?php echo CHtml::button('No tengo cuenta y deseo registrarme', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/site/register') . '"', 'class' => 'btn btn-secondary form-control')); ?></th>
					</tr>
				</table>
			</div>
		</div>
		
	</div>
	<br>
</div>

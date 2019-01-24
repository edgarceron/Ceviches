
<div class="row">
	<div class="col-md-12">
		<?php echo CHtml::button('Generar', array('class' => 'btn btn-primary form-control', 'id' => 'btn-generar', 'onclick' => 'autenticar()')); ?>
	</div>
	<div style="height:70px">
	
	</div>
</div>

<script>
	function autenticar(){
		jQuery.ajax({
			'type':'POST',
			'dataType':'json',
			'async':false,
			'url':'https://dev.api.mensajerosurbanos.com/oauth/token',
			'data':{
				'client_id':'5b3d1c49d5608_murbanos',
				'client_secret':'4b51943fda751148483027219396c113c23755d2',
				'grant_type':'client_credentials'
			},
			'cache':false,
			'success':function(json){
				alert('yay');
			}
		});	
	}
</script>
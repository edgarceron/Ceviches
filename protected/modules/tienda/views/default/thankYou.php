<style type="text/css">
.bgimg {
    background-image: url('<?php echo Yii::app()->baseUrl.'/images/Fotos-Pescadores-Mariscos.jpg'?>');
	height: 100%;
}
</style>
<div style="text-align: center; color: white;" class="bgimg">
	<div> 
		<h1 class="display-4"><b>¡Gracias por su compra!</b></h1>
		<img src="<?php echo Yii::app()->request->baseUrl.'/images/logo_ceviche_y_mar.png'?>" class="img-fluid">
		<p class="lead"><strong>Hemos recibido su pedido y hemos enviado un correo a su dirección de correo con los detalles.</strong></p>
		<p class="lead"><strong><?php echo $mensaje ?></strong></p>
		<p class="lead"><strong> Puede consultar el estado de su pedido <b><?php echo CHtml::link('aquí', Yii::app()->createUrl('/tienda/default/verPedido', 
			array('id_pedido' => $id_pedido)), 
			array('style' => 'color:white'));?></b></strong> </p>
		<p class="lead"><strong>El codigo de su pedido es: <?php echo $luigi ?></strong></p>
	</div>
</div>
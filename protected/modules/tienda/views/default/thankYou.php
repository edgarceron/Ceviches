<div style="position: relative; text-align: center; color: white;">
	<img src="<?php echo Yii::app()->request->baseUrl.'/images/Fotos-Pescadores-Mariscos.jpg'?>" class="img-fluid" alt="Responsive image">
	<div style="position: absolute; top: 8px; width:100%"> 
		<img src="<?php echo Yii::app()->request->baseUrl.'/images/logo_ceviche_y_mar.png'?>" class="img-fluid">
		<h2>Hemos recibido su pedido y un email ha sido enviado con el resumen de su compra</h2>
		<h2>Puede consultar el estado de su pedido <strong><?php echo CHtml::link('aquí', Yii::app()->createUrl('/tienda/default/verPedido', 
			array('id_pedido' => $id_pedido)), 
			array('style' => 'color:white'));?></strong> </h2>
		<h2>El codigo Luigi de su pedido es: <strong><?php echo $luigi ?></strong></h2>
	</div>
</div>
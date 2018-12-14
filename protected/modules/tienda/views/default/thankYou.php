<div style="position: relative; text-align: center; color: white;">
	<img src="<?php echo Yii::app()->request->baseUrl.'/images/Fotos-Pescadores-Mariscos.jpg'?>" class="img-fluid" alt="Responsive image">
	<div style="position: absolute; top: 8px; left: 16px;"> 
		<h1>Gracias por su compra</h1>
		<h2>Se envio un correo a su dirección de email con los datos del pedido</h2>
		<h2>Puede consultar el estado de su pedido <?php echo CHtml::link('aquí', Yii::app()->createUrl('/tienda/default/verPedido', 
			array('id_pedido' => $id_pedido)), 
			array('style' => 'color:white'));?> </h2>
		
	</div>
<div>
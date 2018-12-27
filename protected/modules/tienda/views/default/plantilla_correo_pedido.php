<div style="background: none repeat scroll 0 0 rgba(255, 255, 255, 0.3);
			font-family: arial;
			height: 120px;
			padding: 2%;
			text-align: center;
			width: 96%;">
	<h2><img src="https://cevicheymar.com/Ceviches/images/logo_ceviche_y_mar.png" style="width: 100px"/></h2>
</div>
<div style="background: none repeat scroll 0 0 #F1F2F2;
	font-family: arial;
	height: 30%;
	padding: 2%;
	text-align: center;
	width: 96%;">
	<h3>Sr. <?php echo $nombre ?> gracias por su pedido en ceviche y mar</h3>
	<h2>Puede consultar el estado de su pedido <a href="<?php echo $url?>" style="color:black">aquí</a> </h2>
	<h2>Resumen del pedido</h2>
	<table class="table">
		<thead>
			<tr>
				<th scope="col"></th>
				<th scope="col">Producto</th>
				<th scope="col">Cantidad</th>
				<th scope="col">Precio unidad</th>
				<th scope="col">Subtotal</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$total = 0;
		foreach($detalles as $detalle){
			
			$cantidad = $detalle['cantidad_detalle'];
			$nombre = $detalle['descripcion_detalle'];
			$precio = $detalle['valor_unitario_detalle'];
			$imagen = $detalle['foto_detalle'];
			
			$total += ($cantidad * $precio);
		?>	
			<tr>
				<td><img src="<?php echo $rutaImagenes.$imagen ?>"></td>
				<td>
					<h6 class="my-0"><?php echo $nombre ?></h6>
				</td>
				<td>
					<div class="row">
						<div class="form-group col-md-3">
							<?php echo CHtml::label($cantidad, '') ?>
						</div>
						
					</div>
				</td>
				<td><span class="text-muted"><label>$<?php echo number_format($precio, 0, ",", ".") ?></label></span></td>
				<td><span class="text-muted"><label>$<?php echo number_format(($precio * $cantidad), 0, ",", ".") ?></label></span></td>
			</tr>
		<?php
		}
		?>  
			<tr>
				<td colspan = 3>
				
				</td>
				<td>
					Total
				</td>
				<td>
					<label id="total">$<?php echo number_format($total, 0, ",", ".") ?></label>
				</td>
			</tr>
		</tbody>
	</table>
	
	<h4>Dirección de entrega</h4>
		<?php 
			echo $pedido['direccion_pedido'];
		?>

	<h4>Medio de pago</h4>
	<?php echo $pedido['medio_pago_pedido'] ?>
	
</div>

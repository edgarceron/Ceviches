
<div class="row">
	<div class="col-md-6 border border-secondary">
		<h4>Dirección</h4>
		<div class="form-group col-md-12">
			<?php 
				echo $pedido['direccion_pedido'];
			?>
		</div>
	</div>
	<div class="col-md-6 border border-secondary">
		<h4>Medio de pago</h4>
		<?php echo $pedido['medio_pago_pedido'] ?>
		<h4>Estado</h4>
		<?php echo $pedido['estado_pedido'] ?>
	</div>
	<div class="col-md-12">
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
					<td><img src="<?php echo Yii::app()->request->baseUrl."/images/$imagen" ?>"></td>
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
	</div>
</div>


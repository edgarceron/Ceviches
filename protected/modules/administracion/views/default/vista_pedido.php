
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-<?php echo $c?>" role="alert">
			<?php echo $mensaje?>
		</div>
	</div>	
	<div class="col-md-6 border border-secondary">
		<h4>Dirección</h4>
		<div class="form-group col-md-12">
			<?php 
				echo $usuario['nombre'] . " " . $usuario['apellido'] . "<br>";
				echo $pedido['direccion_pedido'];
			?>
		</div>
		
		<div class="form-group col-md-12">
			
			<?php 
			if($detalle_mu != array() || $uuid){
				if($uuid){
					echo 'Id mensajeros urbanos: ' . $uuid;
				}
				if($detalle_mu != array()){
			?>
				<h4>Detalle mensajeros urbanos</h4>
				Valor del domicilio(Cobrado a Ceviche y mar): <?php echo $detalle_mu['total_value'] ?><br>
				Estado del domicilio: <?php echo $detalle_mu['status'] ?><br>
				Direcciones: <br><?php 
					foreach($detalle_mu['addresses'] as $address){
						echo $address['address'] . "<br>";
					}
				?><br>
				Historial: <br><?php
					foreach($detalle_mu['history'] as $history){
						echo $history['status'] . ":" . $history['date'] . "<br>";
					}
				}
			}
		?>
		</div>
	</div>
	<div class="col-md-6 border border-secondary">
		<h4>Medio de pago</h4>
		<?php echo $pedido['medio_pago_pedido'] ?>
		<h4>Estado</h4>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'eventos-eventos-form',
			'action'=>Yii::app()->createUrl('/administracion/default/verPedido', array('id_pedido' => $id_pedido)),
			// Please note: When you enable ajax validation, make sure the corresponding
			// controller action is handling ajax validation correctly.
			// See class documentation of CActiveForm for details on this,
			// you need to use the performAjaxValidation()-method described there.
			'enableAjaxValidation'=>false,
		)); ?>
			<?php echo $form->labelEx($pedido,'estado_pedido',array('class'=>'label label-success')); ?>
			<?php echo $form->dropDownList(
				$pedido,
				'estado_pedido',
				array('Recibido' => 'Recibido', 'Preparando' => 'Preparando', 'Despachado' => 'Despachado'),
				array('class'=>'form-control')); ?>
			<?php echo CHtml::submitButton('Cambiar estado',array('class'=>'btn btn-primary')); ?>
		<?php $this->endWidget(); ?>
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
						Domicilio
					</td>
					<td>
						<label id="total">$<?php echo number_format($pedido['domicilio_pedido'], 0, ",", ".") ?></label>
					</td>
				</tr>
				
				<tr>
					<td colspan = 3>
					
					</td>
					<td>
						Descuento, Codigo promocional: <b><?php echo $pedido["codigo_promocional_pedido"] ?></b>
					</td>
					<td>
						<span class="text-muted"><label id="total">$<?php echo number_format((-1 * $pedido['descuento_pedido']), 0, ",", ".") ?></label></span>
					</td>
				</tr>
				
				<tr>
					<td colspan = 3>
					
					</td>
					<td>
						<b>Total</b>
					</td>
					<td>
						<label id="total"><b>$<?php echo number_format($total + $pedido['domicilio_pedido'] - $pedido['descuento_pedido'], 0, ",", ".") ?></b></label>
					</td>
				</tr>
			</tbody>
		</table>	
	</div>
	
	<div class="col-md-12">
		
	</div>
</div>


<?php 
	if($medio_pago == 1){
		$accion = Yii::app()->createAbsoluteUrl("/tienda/default/crearPedido");
	}
	else{
		$accion = 'https://checkout.payulatam.com/ppp-web-gateway-payu/';
		$merchantId = OpcionesTienda::model()->find('descripcion = "merchantId_payu"')['valor'];
		$apiLogin = OpcionesTienda::model()->find('descripcion = "apiLogin_payu"')['valor'];
		$apiKey = OpcionesTienda::model()->find('descripcion = "apiKey_payu"')['valor'];
		$accountId = OpcionesTienda::model()->find('descripcion = "accountId_payu"')['valor'];;
		$currency = "COP";
		$referenceCode = "CYM" . $id_pedido;
	}
	
	$id_direccion = $direccion['id'];
	$id_usuario = Yii::app()->user->id;
	
	$form=$this->beginWidget('CActiveForm', array(
		'id'=>'finalaizar-form',
		'action'=>$accion,
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	));
?>
<h2>Resumen del pedido</h2>
<div class="row">
	<div class="col-md-6 border border-secondary">
		<h4>1. Dirección</h4>
		<div class="form-group col-md-12">
			<?php 
			
			echo $direccion_texto;
			if($medio_pago == 1){
				echo CHtml::hiddenField('direccion', $direccion_texto);
				echo CHtml::hiddenField('id_direccion', $id_direccion);
				echo CHtml::hiddenField('telefono', $direccion['telefono_direccion']);
				echo CHtml::hiddenField('id_ciudad', $id_ciudad);
			}
			else{
				echo CHtml::hiddenField('merchantId', $merchantId);
				echo CHtml::hiddenField('apiLogin', $apiLogin);
				echo CHtml::hiddenField('accountId', $accountId);
				echo CHtml::hiddenField('description', "Pedido ceviche y mar " . $id_pedido);
				echo CHtml::hiddenField('referenceCode', $referenceCode);
				echo CHtml::hiddenField('currency', $currency);
				echo CHtml::hiddenField('shippingAddress', substr($direccion_texto, 0, 255));
				echo CHtml::hiddenField('shippingCity', $ciudad['nombre_ciudad']);
				echo CHtml::hiddenField('shippingCountry', "CO");
				echo CHtml::hiddenField('telephone', $direccion['telefono_direccion']);
			}	
			?>
		</div>	
		<div class="col-md-12" id="formularioDireccion">
		
		</div>
	</div>
	<div class="col-md-1">
	</div>
	<div class="col-md-5 border border-secondary">
		<h4>2. Medio de pago</h4>
			<?php 
				$medios_pago = array(1 => 'Efectivo', 2 => 'PayU');
				$meido_pago_texto = $medios_pago[$medio_pago];
				echo CHtml::hiddenField('medio_pago', $medio_pago);
				$codigo_promocional_id = '';
			?>
			<table>
				<tr>
					<td>
						<img src="<?php echo Yii::app()->request->baseUrl.'/images/' . $meido_pago_texto . '.png'?>">
					</td>
				</tr>
			</table>
		<br>	
			<?php
				if($codigo != null){
					echo "Codigo promocional: <b>" . $codigo['codigo'] . "</b><br>";
					echo $codigo['mensaje'];
					$codigo_promocional_id = $codigo['id'];
				}
				echo CHtml::hiddenField('codigo_promocional_id', $codigo_promocional_id);
			?>
	</div>
</div>
<br>
<div class="row">
	<div class="form-group col-md-12">
		<h4>3. ¿Desea su pedido para ya o para despues?</h4>
	</div>	
	<div class="form-group col-md-6">
		<?php
			if($programacion == 2){
				echo 'Para despues, fecha: ' . $fecha;
			}
			else{
				echo 'Para ya';
			}
			echo CHtml::hiddenField('fecha', $fecha);
		?>
	</div>	
</div>
<br>
<div class="row">
	<h4>4. Pedido</h4>
	<div class="tbres">
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
			$cont = 1;
			$total = 0;
			foreach($items as $detalle){
				$item = $detalle['item'];
				$id = $item['id'];
				unset($item['id']);
				$variables = $item;
				$cantidad = $detalle['cantidad'];
				
				$producto = Productos::model()->findByPk($id);
				$nombre = $producto['nombre_producto'];
				$precio = $producto['precio_producto'];
				$imagen = $producto['imagenp_producto'];
				
				
				
				$aumento = 0;
				$variable_str = "";
				foreach(array_keys($variables) as $v){
					$idv = $variables[$v];
					$vp = VariablesProducto::model()->find("id_producto = $id AND id_tipo_variable = $v AND id_variable= $idv");
					$var = Variables::model()->findByPk($idv);
					$variable_str .= $var['descripcion_tipo_variable']. ",";
					if($vp != null){
						if($vp['afecta_precio'] == 1){
							$precio = $vp['precio'];
						}
						else if($vp['afecta_precio'] == 2){
							$aumento += $vp['precio'];
						}
					}
				}
				$variable_str = substr($variable_str, 0, -1);
				$precio += $aumento;
				$total += ($cantidad * $precio);
				
			?>	
				<tr>
					<td><img src="<?php echo Yii::app()->request->baseUrl."/images/productos/$id/$imagen" ?>"></td>
					<td>
						<h6 class="my-0"><?php echo $nombre ?></h6>
						<small class="text-muted"><?php echo $variable_str ?></small>
					</td>
					<td>
						<div class="row">
							<div class="form-group col-md-3">
								<?php echo CHtml::label($cantidad, '',
								array('id' => "cantidad" . $cont)) ?>
							</div>
							
						</div>
					</td>
					<td><span class="text-muted"><label id="<?php echo "precio" . $cont?>">$<?php echo number_format($precio, 0, ",", ".") ?></label></span></td>
					<td><span class="text-muted"><label id="<?php echo "subtotal" . $cont?>">$<?php echo number_format(($precio * $cantidad), 0, ",", ".") ?></label></span></td>
				</tr>
			<?php
				$cont++;
			}
			
			if($codigo != null){
				$tipo = $codigo['tipo'];
				$valor = $codigo['valor'];
				if($tipo == 1){
					$descuento = ($total * ($valor / 100));
				}
				else if($tipo == 2){
					$descuento = $valor;
				}
				$total = $total - $descuento;
				if($total < 0) $total = 0;
			}
			?>  
				<tr>
					<td colspan = 3>
					
					</td>
					<td>
						Domicilio
					</td>
					<td>
						<span class="text-muted"><label id="total">$<?php echo number_format($valor_domicilio, 0, ",", ".") ?></label></span>
					</td>
				</tr>
			<?php if($codigo != null){ ?>	
				<tr>
					<td colspan = 3>
					
					</td>
					<td>
						Codigo promocional: <b><?php echo $codigo['codigo'] ?></b>
					</td>
					<td>
						<span class="text-muted"><label id="total">-$<?php echo number_format($descuento, 0, ",", ".") ?></label></span>
					</td>
				</tr>
			<?php } ?>
				<tr>
					<td colspan = 3>
					
					</td>
					<td>
						<b>Total</b>
					</td>
					<td>
						<label id="total"><b>$<?php echo number_format($total + $valor_domicilio, 0, ",", ".") ?></b></label>
						<?php 
						if($medio_pago == 2){
							echo CHtml::hiddenField('amount', $total + $valor_domicilio);
							echo CHtml::hiddenField('tax', 0);
							echo CHtml::hiddenField('taxReturnBase', 0);
							echo CHtml::hiddenField('test', 1);
							echo CHtml::hiddenField('buyerEmail', $email);
							echo CHtml::hiddenField('buyerFullName', $nombre_completo);
							echo CHtml::hiddenField('responseUrl', Yii::app()->createAbsoluteUrl("/tienda/default/crearPedido/id/$id_pedido/tipo/payu/id_ciudad/$id_ciudad/id_direccion/$id_direccion"));
							//echo CHtml::hiddenField('responseUrl', Yii::app()->createAbsoluteUrl("/tienda/default/thankYou/id_pedido/$id_pedido/tipo/payu"));
							echo CHtml::hiddenField('confirmationUrl', Yii::app()->createAbsoluteUrl("/tienda/default/notificarPedido/id/$id_pedido/id_ciudad/$id_ciudad/id_direccion/$id_direccion/id_usuario/$id_usuario"));
							$signature = $apiKey . "~" . $merchantId . "~" . $referenceCode . "~" . ($total + $valor_domicilio) . "~" . $currency;
							$md5s = md5($signature);
							echo CHtml::hiddenField('signature', $md5s);
						}
						?>
					</td>
				</tr>
			</tbody>
		</table>
		<?php echo CHtml::hiddenField('items_string', $items_string); ?>
	</div>
	
	
</div>
<br>
<div class="row">
	<div class="col-md-12">
		<?php echo CHtml::submitButton('Finalizar', array('class' => 'btn btn-primary form-control', 'id' => 'btn-finalizar')); ?>
	</div>
	<div style="height:70px">
	
	</div>
</div>
<?php $this->endWidget(); ?>

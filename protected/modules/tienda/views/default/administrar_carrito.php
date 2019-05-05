<div class="card">
	<div class="card-header">
		<h3>Mi Carrito</h3>
	</div>
	<div class="card-body">
		
		<div class="tbres">
				<table class="table">
					<thead>
						<tr>
							<th scope="col"></th>
							<th scope="col">Producto</th>
							<th scope="col">Cantidad</th>
							<th scope="col">Precio unidad</th>
							<th scope="col">Subtotal</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php
					$vars = "\n";
					$cont = 1;
					$total = 0;
					foreach($items as $detalle){
						$item = $detalle['item'];
						$jsonitem = json_encode($item);
						$vars = $vars . "var" . $cont . " = " . "'". $jsonitem ."';\n";
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
								<h6 class="my-0" id="nombre<?php echo $cont ?>"><?php echo $nombre ?></h6>
								<small class="text-muted"><?php echo $variable_str ?></small>
							</td>
							<td>
								<div class="row">
									<div class="form-group col-md-2">
										<a href="#" class="btn btn-warning" onclick="disminuir(<?php echo "var" . $cont ?>,<?php echo $cont ?>)"><img src="<?php echo Yii::app()->request->baseUrl.'/images/minus.png' ?>"/></a> 
									</div>
									<div class="form-group col-md-3">
										<?php echo CHtml::textField('cantidad' . $cont, $cantidad, 
										array("class" => "form-control", "maxlength" => "2", 'id' => "cantidad" . $cont, "onchange" => "actualizarCantidad(var$cont, $cont)")) ?>
									</div>
									<div class="form-group col-md-2">
										<a href="#" class="btn btn-success" onclick="aumentar(<?php echo "var" . $cont ?>,<?php echo $cont ?>)"><img src="<?php echo Yii::app()->request->baseUrl.'/images/add.png' ?>"/></a> 
									</div>
								</div>
							</td>
							<td><span class="text-muted"><label id="<?php echo "precio" . $cont?>">$<?php echo number_format($precio, 0, ",", ".") ?></label></span></td>
							<td><span class="text-muted"><label id="<?php echo "subtotal" . $cont?>">$<?php echo number_format(($precio * $cantidad), 0, ",", ".") ?></label></span></td>
							<td><img src="<?php echo Yii::app()->request->baseUrl."/images/delete2.png" ?>" onclick="quitarProducto(<?php echo "var" . $cont ?>)" ></td>
						</tr>
					<?php
						$cont++;
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
							<td>
							</td>
						</tr>
					</tbody>
				</table>
				<script>
					<?php echo $vars ?>
					
					function quitarProducto(item){
						var obj = JSON.parse(item);
						<?php 	
						echo CHtml::ajax(
							array(
								'type'=>'GET',
								'dataType'=>'html',
								'async'=> false,
								'url' => Yii::app()->createAbsoluteUrl('/tienda/default/deleteItem'),
								'data' => 'js:obj',
							)
						); ?>
						ga('ec:addProduct', {
							'id': obj.id,
							'name': obj.name,
							'quantity': product.qty
						});
						ga('ec:setAction', 'add');
						ga('send', 'event', 'UX', 'click', 'add to cart');     // Send data using an event.

						location.reload(); 
					}
					
					function aumentar(item, contador){
						var textF = "#cantidad" + contador;
						var cantidad = parseInt($(textF).val()) + 1;
						$(textF).val(cantidad);
						actualizarCantidad(item, contador);
					}
					
					function disminuir(item, contador){
						var textF = "#cantidad" + contador;
						var cantidad = parseInt($(textF).val()) - 1;
						$(textF).val(cantidad);
						actualizarCantidad(item, contador);
					}
					
					function actualizarCantidad(item, contador){
						var obj = JSON.parse(item);
						var textF = "#cantidad" + contador;
						var valor = $(textF).val();
						<?php 	
						echo CHtml::ajax(
							array(
								'type'=>'GET',
								'dataType'=>'html',
								'async'=>false,
								'url' => Yii::app()->createAbsoluteUrl('/tienda/default/cambiarCantidad'),
								'data' => array('item' => 'js:obj', 'cantidad' => 'js:valor'),
								'update'=>'#carrito',
							)
						); ?>
						
						var textF = "#cantidad" + contador;
						var textP = "#precio" + contador;
						var textS = "#subtotal" + contador;
						var precio = parseInt($(textP).text().replace('.','').substr(1)); 
						var cantidad = parseInt($(textF).val());
						var subtotal = cantidad * precio;
						
						const formatter = new Intl.NumberFormat('es-ES', {
						  style: 'decimal',
						  minimumFractionDigits: 0
						});
								// Just naively convert to string for now
						var dataString = '$' + formatter.format(subtotal);
						
						$(textS).text(dataString);
						
						if(cantidad <= 0){
							location.reload(); 
						}
						else{
							var total = 0;
							for(var i = 1; i <= <?php echo count($items) ?>; i++){
								textF = "#cantidad" + i;
								textP = "#precio" + i;
								precio = parseInt($(textP).text().replace('.','').substr(1)); 
								cantidad = parseInt($(textF).val());
								subtotal = cantidad * precio;
								total += subtotal;
							}
							dataString = '$' + formatter.format(total);
							$("#total").text(dataString);
						}
					}
				</script>	
		</div>

		<?php echo CHtml::button('Finalizar pedido', array('onclick' => 'js:document.location.href="'. Yii::app()->createUrl('/tienda/default/finalizarPedido'). '"', 'class' => 'btn btn-primary form-control')); ?>
	</div>
</div>
<br>
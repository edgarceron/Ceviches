<div class="row">
	<div class="col-md-12">
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
				
			?>	
				<tr>
					<td><img src="<?php echo Yii::app()->request->baseUrl."/images/productos/$id/$imagen" ?>"></td>
					<td>
						<h6 class="my-0"><?php echo $nombre ?></h6>
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
					<td><span class="text-muted">$<?php echo $precio ?></span></td>
					<td><span class="text-muted">$<?php echo ($precio * $cantidad)?></span></td>
					<td><img src="<?php echo Yii::app()->request->baseUrl."/images/delete2.png" ?>" onclick="quitarProducto(<?php echo "var" . $cont ?>)" ></td>
				</tr>
			<?php
				$cont++;
			}
			?>  
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
						'async'=>'false',
						'url' => Yii::app()->createAbsoluteUrl('/tienda/default/deleteItem'),
						'data' => 'js:obj',
					)
				); ?>
				
				setTimeout(function(){
					location.reload(); 
				}, 300);
				
			}
			
			function aumentar(item, cantidad){
				var textF = "#cantidad" + cantidad;
				$(textF).val(parseInt($(textF).val()) + 1);
				actualizarCantidad(item, cantidad);
			}
			
			function disminuir(item, cantidad){
				var textF = "#cantidad" + cantidad;
				$(textF).val($(textF).val() - 1);
				actualizarCantidad(item, cantidad);
			}
			
			function actualizarCantidad(item, cantidad){
				var obj = JSON.parse(item);
				var textF = "#cantidad" + cantidad;
				var valor = $(textF).val();
				<?php 	
				echo CHtml::ajax(
					array(
						'type'=>'GET',
						'dataType'=>'html',
						'async'=>'false',
						'url' => Yii::app()->createAbsoluteUrl('/tienda/default/cambiarCantidad'),
						'data' => array('item' => 'js:obj', 'cantidad' => 'js:valor'),
						'update'=>'#carrito',
					)
				); ?>
				if(valor <= 0){
					setTimeout(function(){
						location.reload(); 
					}, 300);
				}
			}
		</script>	
	</div>
</div>

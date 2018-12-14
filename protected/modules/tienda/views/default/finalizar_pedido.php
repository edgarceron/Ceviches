<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'finalaizar-form',
		'action'=>Yii::app()->createAbsoluteUrl('/tienda/default/checkout'),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); ?>
<div class="row">
		<div class="col-md-6 border border-secondary">
			<h4>Dirección</h4>
			<div class="form-group col-md-12">
				<?php 
				if($lista_direcciones == array()){
						$lista_direcciones[0] = 'No tiene direcciones para mostrar';
				}
				echo CHtml::dropDownList('direccion', null, $lista_direcciones, array('id'=>'direccion', 'class'=>'form-control', 'onchange' => 'cargarFormulario(1)')); 
				echo '<br>';
				echo CHtml::button('Añadir dirección',array('class'=>'btn btn-primary', 'onclick' => 'cargarFormulario(0)')); 
				?>
			</div>	
			<div class="col-md-12" id="formularioDireccion">
			
			</div>
		</div>
		<div class="col-md-6 border border-secondary">
			<h4>Medio de pago</h4>
			<?php echo CHtml::dropDownList('medio_pago', null, array(1 => 'Efectivo', 2 => 'PayU'), array('id'=>'medio_pago', 'class'=>'form-control')); ?>
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
					
					$total += ($cantidad * $precio);
					
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
			<?php echo CHtml::submitButton('Finalizar', array('class' => 'btn btn-primary form-control')); ?>
			<script>
			function cargarFormulario(ev){
				if(ev == 1){
					var id_dir = $("#direccion").val();
				}
				else{
					var id_dir = 0;
				}
				jQuery.ajax(
					{
						'type':'GET',
						'dataType':'html',
						'async':'false',
						'url':'http://localhost/Ceviches/index.php/direcciones/default/formulario',
						'data':{'id':id_dir,'partial':1},
						'cache':false,
						'success':function(html){jQuery("#formularioDireccion").html(html)}
					}
				);		
			}
				
			function nombreDireccion(nombre){
				document.getElementById("nombre_direccion").value =  nombre;
			}
			</script>	
		</div>
</div>
<?php $this->endWidget(); ?>

<table class="table">
	<thead>
		<tr>
			<th scope="col"></th>
			<th scope="col" style="white-space: nowrap;">Nombre Producto</th>
			<th scope="col">Cant.</th>
			<th scope="col">Subtotal</th>
		</tr>
	</thead>
	<tbody>

<?php
if($items != null){
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
			$variable_str .= $var['descripcion_tipo_variable']. ", ";
			if($vp != null){
				if($vp['afecta_precio'] == 1){
					$precio = $vp['precio'];
				}
				else if($vp['afecta_precio'] == 2){
					$aumento += $vp['precio'];
				}
			}
		}
		$variable_str = substr($variable_str, 0, -2);
		$precio += $aumento;
		$total += $precio * $cantidad;
		
?>			
		<tr>
			<td><img src="<?php echo Yii::app()->request->baseUrl."/images/productos/$id/$imagen" ?>"></td>
			<td><h6 class="my-0"><?php echo $nombre ?></h6><small class="text-muted"><?php echo $variable_str ?></small></td>
			<td><span class="text-muted"><?php echo $cantidad ?></span></td>
			<td><span class="text-muted">$<?php echo number_format(($precio * $cantidad), 0, ",", ".")?></span></td>
		</tr>
<?php
	}
?>
		<tr>
			<td colspan=3>
				Total:
			</td>
			<td>
				$<?php echo number_format($total, 0, ",", "."); ?>
			</td>
		</tr>
<?php
}
else{
	echo "Aun no tiene articulos en su carrito de compras";
}
?>  
		<tr>
			<td colspan="4"><?php echo CHtml::link('Ver carrito', Yii::app()->createUrl('tienda/default/carrito'), 
				array("class" => "form-control btn-primary", "style" => "text-align:center"))?></td>
		</tr>
	</tbody>
</table>


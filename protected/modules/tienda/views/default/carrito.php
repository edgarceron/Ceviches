<table class="table">
	<thead>
		<tr>
			<th scope="col"></th>
			<th scope="col">Producto</th>
			<th scope="col">Cantidad</th>
			<th scope="col">Subtotal</th>
		</tr>
	</thead>
	<tbody>

<?php
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
	
	foreach(array_keys($variables) as $v){
		$idv = $variables[$v];
		$vp = VariablesProducto::model()->find("id_producto = $id AND id_tipo_variable = $v AND id_variable= $idv");
		if($vp != null){
			if($vp['afecta_precio'] == 1){
				$precio = $vp['precio'];
			}
			else if($vp['afecta_precio'] == 2){
				$aumento += $vp['precio'];
			}
		}
	}
	$precio += $aumento;
	
?>
		
		<tr>
			<td><img src="<?php echo Yii::app()->request->baseUrl."/images/productos/$id/$imagen" ?>"></td>
			<td><h6 class="my-0"><?php echo $nombre ?></h6></td>
			<td><span class="text-muted"><?php echo $cantidad ?></span></td>
			<td><span class="text-muted">$<?php echo ($precio * $cantidad)?></span></td>
		</tr>
	

<?php
}
?>  
		<tr>
			<td colspan="4"><?php echo CHtml::link('Ver carrito', Yii::app()->createUrl('tienda/default/carrito'), 
				array("class" => "form-control btn-primary", "style" => "text-align:center"))?></td>
		</tr>
	</tbody>
</table>


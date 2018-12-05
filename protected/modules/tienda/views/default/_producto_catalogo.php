<?php
	$imagen = $producto['imagen'];
	$nombre = $producto['nombre'];
	$precio = $producto['precio'];
?>
<div class="col-sm-3">
	<div class="card">
		<img class="card-img-top" src="<?php echo Yii::app()->request->baseUrl."/images/productos/$id/$imagen" ?>?text=<?php echo $nombre ?>" alt="Card image cap">
		
		<div class="card-body">
			<h6 class="card-title"><?php echo $nombre ?></h6>
			<div class="form-group col-md-12">
			
				<?php 
				$data['id'] = $id;
				$data['cantidad'] = "js:$('#c$id').val()";
				$lista_variables = array_keys($producto['variables']);
				foreach($lista_variables as $variable){
					if(!isset($label)){
						$record = TiposVariable::model()->findByPk($variable);
						$label = $record['nombre_tipo_variable'];
					}
					$ak = array_keys($producto['variables'][$variable]);
					$opciones = array();
					$burbujas = array();
					foreach($ak as $k){
						$opciones[$k] = $producto['variables'][$variable][$k]['descripcion'];
						if($producto['variables'][$variable][$k]['afecta_precio'] == 1){
							$burbujas[$k] = $producto['variables'][$variable][$k]['precio'];
						}
						else if($producto['variables'][$variable][$k]['afecta_precio'] == 2){
							$burbujas[$k] = $precio + $producto['variables'][$variable][$k]['precio'];
						}	
					}
					$data[$variable] = "js:$('#v" . $id . "-" . $variable . "').val()";
					echo CHtml::label($label, 'v' . $id . "-". $variable); 
					echo CHtml::dropDownList('v' . $id . "-". $variable,null, $opciones, array('id'=>'v' . $id . "-" . $variable, 'class'=>'form-control')); 
					unset($label);
				}
				echo CHtml::label('Cantidad', 'c' . $id); 
				echo CHtml::textField('c' . $id, '1', array('id'=>'c' . $id, 'class'=>'form-control', "style" => "text-align:center"));
				echo "<br>";
				echo CHtml::button('Añadir al carrito', array('id' => 'add' . $id, 'class' => 'form-control btn-primary', 'onclick' => 'add' . $id . '()'));	
				?>
			</div>
		</div>
	</div>
	<script>
	function add<?php echo $id ?>(){
		<?php 
		echo CHtml::ajax(
			array(
				'type'=>'GET',
				'dataType'=>'html',
				'async'=>'false',
				'url' => Yii::app()->createAbsoluteUrl('/tienda/default/addItem'),
				'data' => $data,
				'update'=>'#carrito',
			)
		); ?>
		
		$("#mensaje_carrito").html("Se añadio <?php echo $nombre ?> correctamente");
		$('#mensaje_carrito').collapse('toggle');
		setTimeout(function(){
			$('#mensaje_carrito').collapse('toggle');
		}, 5000);
		
	}
	</script>
</div>
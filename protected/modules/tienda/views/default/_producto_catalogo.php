<?php
	$imagen = $producto['imagen'];
	$nombre = $producto['nombre'];
	$precio = $producto['precio'];
	for($i = 1;$i<=99;$i++){
		$cantidades[$i] = "$i";
	}
?>
<div class="col-sm-3">
	<div class="card">
		<img class="card-img-top" src="<?php echo Yii::app()->request->baseUrl."/images/productos/$id/$imagen" ?>?text=<?php echo $nombre ?>" alt="Card image cap">
		
		<div class="card-body">
			<h6 class="card-title"><?php echo $nombre ?></h6>
			<div class="form-group col-md-12">
			
				<?php 
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
					$data[$variable] = "$('#v" . $id . "-" . $variable . "').val()";
					echo CHtml::label($label, 'v' . $id . "-". $variable); 
					echo CHtml::dropDownList('v' . $id . "-". $variable,null, $opciones, array('id'=>'v' . $id . "-" . $variable, 'class'=>'form-control')); 
					unset($label);
				}
				echo CHtml::label('Cantidad', 'c' . $id); 
				echo CHtml::dropDownList('c' . $id, 1, $cantidades, array('id'=>'c' . $id, 'class'=>'form-control', "style" => "text-align:center"));
				echo "<br>";
				echo CHtml::button('Añadir al carrito', array('id' => 'add' . $id, 'class' => 'form-control btn-primary', 'onclick' => 'add' . $id . '()'));	
				?>
			</div>
		</div>
	</div>
	<script>
	var cont_div = 0;
	var topc = 130;
	var className = 'collapse alert alert-success';
	var he = 0;
	function add<?php echo $id ?>(){
		var pos = cont_div;
		var divname = '#divcar' + cont_div;
		var iDiv = document.createElement('div');
		iDiv.id = 'divcar' + cont_div;
		iDiv.className = className;
		iDiv.style.position = "fixed";
		iDiv.style.top = '' + topc + 'px';
		iDiv.style.right = "10px";
		iDiv.style.zIndex = "0";
		iDiv.style.width = "50%";
		iDiv.style.cssFloat = "none";
		document.getElementsByTagName('body')[0].appendChild(iDiv);
		jQuery.ajax(
			{
				'type':'GET',
				'dataType':'html',
				'async':false,
				'url':'<?php echo Yii::app()->createUrl('/tienda/default/addItem')?>',
				'data':{'id':<?php echo $id ?>,'cantidad':<?php echo "$('#c" . $id . "').val()" ?>
					<?php
						foreach(array_keys($data) as $d){
							 echo ",'$d':" . $data[$d];
						}
					?>},
				'cache':false,
				'error':function(ob, textStatus, error){alert(error);},
				'success':function(html){
					jQuery("#carrito").html(html);
					$(divname).collapse('show');
					$(divname).html("Se añadio <?php echo $nombre ?> correctamente");
					$(divname).collapse('show');

					
					setTimeout(function(){
						$(divname).collapse('hide');
						topc = topc - he;
						var divid = '';
						var aux = 0;
						for(var i = pos + 1; i < cont_div; i++){
							var divid = "divcar" + i;
							aux =  parseInt(document.getElementById(divid).style.top);
							document.getElementById(divid).style.top = (aux - h) + "px"; 
						}
					}, 5000);
					cont_div++;
					topc = topc + he;
				}
			}
		);		
	}
	
	</script>
</div>
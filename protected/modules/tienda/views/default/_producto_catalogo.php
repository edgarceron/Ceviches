<?php
	$imagen = $producto['imagen'];
	$nombre = $producto['nombre'];
	$precio = $producto['precio'];
	$variable_define_precio = false;
	for($i = 1;$i<=99;$i++){
		$cantidades[$i] = "$i";
	}
?>
<div class="col-sm-3">
	<div class="card" style="border:0">
		<a href="<?php echo Yii::app()->createUrl('/tienda/default/verProducto', array('id' => $id)) ?>">
			<img class="card-img-top" src="<?php echo Yii::app()->request->baseUrl."/images/productos/$id/$imagen" ?>?text=<?php echo $nombre ?>" alt="Card image cap" style="padding-top: 20%;">
		</a>
			<?php
			if(isset($producto['variables'])){
				$variables = $producto['variables'];
			}
			else{
				$variables = array();
			}
			$contador = 1;
			$top = 60;
			$right = 0;
			$background_color = '#F55500';
			foreach($variables as $tipo){
				foreach($tipo as $var){
					if($contador > 3) break;
					if($contador == 2){
						$top = 15;
						$right = 50;
						$background_color = '#09B2AC';
					}
					if($contador == 3){
						$top = 0;
						$right = 118;
						$background_color = '#F55500';
					}
					
					$precio = $var['precio'];
					$descripcion = $var['descripcion'];
					if($var['afecta_precio'] == 1){
					$variable_define_precio = true;
					$contador++;
					?>
					<div style="background-color: <?php echo $background_color ?>; 
					border-radius: 100%; height:60px; width: 60px; position: absolute; 
					top: <?php echo $top ?>px; 
					right:<?php echo $right ?>px">
						<div style="position: relative; top: 16px; text-align:center;  color: white; font-weight: bold; font-size: 12px; line-height: 100%;"> 
							$<?php echo number_format($precio, 0, ",", ".") ?><br>
							<?php echo $descripcion ?>
						</div>
					</div>
					<?php
					}
				}
			}
			
			if(!$variable_define_precio){
					$precio = $producto['precio'];
					?>
						<div style="background-color: <?php echo $background_color ?>; 
						border-radius: 100%; height:60px; width: 60px; position: absolute; 
						top: <?php echo $top ?>px; 
						right:<?php echo $right ?>px">
							<div style="position: relative; top: 21px; text-align:center;  color: white; font-weight: bold; font-size: 12px; line-height: 100%;"> 
								$<?php echo number_format($precio, 0, ",", ".") ?><br>
							</div>
						</div>
					<?php
				}
			?>
		
		<div class="card-body">
			<h6 class="card-title" style="height: 2rem;"><a href="<?php echo Yii::app()->createUrl('/tienda/default/verProducto', array('id' => $id)) ?>"><?php echo $nombre ?></a></h6>
			<div class="form-group col-md-12">
			
				<?php 
				if(isset($producto['variables'])){
					$lista_variables = array_keys($producto['variables']);
				}
				else{
					$lista_variables = array();
				}
				$data = array();
				foreach($lista_variables as $variable){
					if(!isset($label)){
						$record = TiposVariable::model()->findByPk($variable);
						$label = $record['nombre_tipo_variable'];
					}
					$ak = array_keys($producto['variables'][$variable]);
					$opciones = array();
					foreach($ak as $k){
						$opciones[$k] = $producto['variables'][$variable][$k]['descripcion'];
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
		var cantidad = <?php echo "$('#c" . $id . "').val()" ?>;
		jQuery.ajax(
			{
				'type':'GET',
				'dataType':'html',
				'async':false,
				'url':'<?php echo Yii::app()->createUrl('/tienda/default/addItem')?>',
				'data':{'id':<?php echo $id ?>,'cantidad':cantidad
					<?php
						foreach(array_keys($data) as $d){
							 echo ",'$d':" . $data[$d];
						}
					?>},
				'cache':false,
				'error':function(ob, textStatus, error){alert(error);},
				'success':function(html){
					jQuery("#carrito").html(html);
					var n = "#numeroItemsCarrito";
					jQuery(n).html(parseInt(jQuery(n).html()) + parseInt(cantidad));
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

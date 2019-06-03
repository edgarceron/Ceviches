<?php
	$imagen = $producto['imagen'];
	$nombre = $producto['nombre'];
	$precio = $producto['precio'];
	$variable_define_precio = false;
	for($i = 1;$i<=99;$i++){
		$cantidades[$i] = "$i";
	}
?>

	<div class="card" style="border:0">
		<div class="card-body">
		
			<div class="row">
				<div class="col-md-6">
					<img class="img-fluid" src="<?php echo Yii::app()->request->baseUrl."/images/productos/$id/$imagen" ?>?text=<?php echo $nombre ?>" alt="Card image cap" style="padding-top: 10%;">
				
				<?php
				$variables = $producto['variables'];
				$contador = 1;
				$top = 120;
				$right = 0;
				$background_color = '#F55500';
				foreach($variables as $tipo){
					foreach($tipo as $var){
						if($contador > 3) break;
						if($contador == 2){
							$top = 35;
							$right = 64;
							$background_color = '#09B2AC';
						}
						if($contador == 3){
							$top = 0;
							$right = 166;
							$background_color = '#F55500';
						}
						
						$precio = $var['precio'];
						$descripcion = $var['descripcion'];
						if($var['afecta_precio'] == 1){
						$variable_define_precio = true;
						$contador++;
						?>
						<div style="background-color: <?php echo $background_color ?>; 
						border-radius: 100%; height:100px; width: 100px; position: absolute; 
						top: <?php echo $top ?>px; 
						right:<?php echo $right ?>px">
							<div style="position: relative; top: 30px; text-align:center;  color: white; font-weight: bold; font-size: 16px; line-height: 100%;"> 
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
						border-radius: 100%; height:100px; width: 100px; position: absolute; 
						top: <?php echo $top ?>px; 
						right:<?php echo $right ?>px">
							<div style="position: relative; top: 40px; text-align:center;  color: white; font-weight: bold; font-size: 16px; line-height: 100%;"> 
								$<?php echo number_format($precio, 0, ",", ".") ?><br>
							</div>
						</div>
					<?php
				}
				?>
				</div>
				<div class="col-md-6">
					<h4 class="card-title" style="height: 2rem;"><?php echo $nombre ?></h4>
					<div class="form-group col-md-12">
						
						<?php 
						echo CHtml::label($producto['descripcion'], null); 
						echo '<br>';
						echo CHtml::label('Calorias: '. Productos::model()->findByPk($id)['calorias_producto'], null); 
						echo '<br>';
						$lista_variables = array_keys($producto['variables']);
						if($lista_variables != array()){
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
								if($label != ""){
									echo CHtml::label($label, 'v' . $id . "-". $variable); 
									echo CHtml::dropDownList('v' . $id . "-". $variable,null, $opciones, array('id'=>'v' . $id . "-" . $variable, 'class'=>'form-control')); 
								}
								unset($label);
							}
						}
						echo CHtml::label('Cantidad', 'c' . $id); 
						echo CHtml::dropDownList('c' . $id, 1, $cantidades, array('id'=>'c' . $id, 'class'=>'form-control', "style" => "text-align:center"));
						echo "<br>";
						echo CHtml::button('Añadir al carrito', array('id' => 'add' . $id, 'class' => 'form-control btn-primary', 'onclick' => 'add' . $id . '()'));	
						?>
					</div>
				</div>
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
					$(divname).collapse('show');
					$(divname).html("Se añadio <?php echo $nombre ?> correctamente");
					$(divname).collapse('show');
					ga('create', 'UA-125725981-2');
					ga('require', 'ec');

					ga('ec:addProduct', {
						'id': '<?php echo $id?>',        // Product ID (string).
						'name': '<?php echo $nombre?>', // Product name (string).
						'quantity': cantidad
					});
					ga('ec:setAction', 'add');
					ga('send', 'event', 'UX', 'click', 'add to cart'); 
					
					
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
	
	// The product being viewed.
	ga('ec:addProduct', {                 // Provide product details in an productFieldObject.
	  'id': '<?php echo $id?>',        // Product ID (string).
	  'name': '<?php echo $nombre?>', // Product name (string).
	});

	ga('ec:setAction', 'detail');       // Detail action.
	
	</script>

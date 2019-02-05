<?php
//Paso de variables a javascrip

$id_tipo = $tipo['id'];
$nombre = $tipo['nombre_tipo_variable'];
$opciones_precio = array(0 => 'No afecta el precio', 1 => 'Remplaza el precio', 2 => 'Añade valor al precio');
foreach($variables_producto as $vp){
	$afecta = $vp['afecta_precio'];
	break;
}	
?>

<div class="form-group col-lg-12" id="<?php echo "tipovariable$id_tipo" . "_div"?>">
	<h4><?php echo $nombre ?></h4>
	<div class="row">
		<div class="form-group col-md-3">
			<?php echo CHtml::label('Comportamiento de la variable: ', "Afecta[$id_tipo]", array())?>
			<?php echo CHtml::dropDownList("Afecta[$id_tipo]", $afecta, $opciones_precio, array('class' => 'form-control'))?>
		</div>
	</div>
	<?php 
	$variables_disponibles = $variables;
	foreach($variables_producto as $vp){
		$id_variable = $vp['id_variable'];
		$descripcion_tipo_variable = $variables[$id_variable];
		?>
	<div class="row" id="<?php echo "variable$id_variable"?>">
		<div class="form-group col-md-3">
			<?php echo CHtml::label($descripcion_tipo_variable, null, array('class' => 'form-control', 'id' => "label$id_variable"))?>
		</div>
		<div class="form-group col-md-3">
			<?php echo CHtml::textField("Valor[$id_variable]", $vp['precio'], array('class' => 'form-control'))?>
		</div>
		<div class="form-group col-md-3">
			<?php echo CHtml::button("Eliminar variable" , array('class' => 'btn btn-primary', 'onclick' => "eliminarVariable($id_variable , $id_tipo)"))?>
		</div>
	</div>
	<?php
		if(isset($variables_disponibles[$id_variable])){
			unset($variables_disponibles[$id_variable]);
		}
	} 
	?>	
</div>
<?php
if(count($variables_disponibles) > 0){
	$display = 'display: block';
}
else{
	$display = 'display: none';
}
?>
<div class="form-group col-lg-12" id="<?php echo "botones$id_tipo" . "_div"?>" style="<?php echo $display ?>">
	<div class="row">
		<div class="form-group col-md-3">
			<?php echo CHtml::dropDownList("variables_select", "", $variables_disponibles, array('class' => 'form-control', 'id' => "variables_select$id_tipo"))?>
		</div>
		<div class="form-group col-md-3">
			<?php echo CHtml::button("Agregar", array('onclick' => "nuevoValorTipoVariable($id_tipo)", 'class' => 'btn btn-primary')) ?>
		</div>
	</div>
</div>


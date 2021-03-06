<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
        $this->module->nombre,
);
?>


<div class="col-sm-12">
	<div class="card">
		<div class="row">
		<?php
		if($tipo_catalogo == 1){
			$keys = array_keys($productos_catalogo);
			foreach($keys as $k){
				$id = $k;
				$producto = $productos_catalogo[$k];
				$this->renderPartial('_producto_catalogo', array('id' => $id, 'producto' => $producto));
			}
		}
		else{
			foreach($lineas as $l){
				$linea = LineasProducto::model()->findByPk($l['id_linea_producto']);
				$descripcion_linea = $linea['descripcion_linea_producto'];
				$nombre_linea = $linea['nombre_linea_producto'];
				$keys = array_keys($productos_catalogo);
				$header = 0;
				foreach($keys as $k){
					$id = $k;
					$producto = $productos_catalogo[$k];
					if($producto['linea'] == $linea['id']){
						if(!$header){
							?>
				<div class="col-sm-12">
					<h2><?php echo $nombre_linea ?></h2>
					<span class="text-muted"><?php echo $descripcion_linea ?></span>
				</div>			
							<?php
							$header = 1;
						}
						$this->renderPartial('_producto_catalogo', array('id' => $id, 'producto' => $producto));
						//echo "----";
						unset($productos_catalogo[$k]);
					}
				}
			}
		}
		?>
		</div>
	</div>
	<br>

	<?php echo CHtml::link('Finalizar pedido', Yii::app()->createUrl('tienda/default/carrito'), 
		array("class" => "form-control btn-primary", "style" => "text-align:center"))?>
	<br>
</div>
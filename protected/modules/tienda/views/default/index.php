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
		foreach($lineas as $l){
			$linea = LineasProducto::model()->findByPk($l['id_linea_producto']);
			$descripcion_linea = $linea['descripcion_linea_producto'];
			$nombre_linea = $linea['nombre_linea_producto'];
			$keys = array_keys($productos_catalogo);
			foreach($keys as $k){
				$id = $k;
				$header = 0;
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
					unset($productos_catalogo[$k]);
				}
			}
		}
		?>
		</div>
	</div>
</div>
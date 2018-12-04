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
			$keys = array_keys($productos_catalogo);
			foreach($keys as $k){
				$id = $k;
				$producto = $productos_catalogo[$k];
				$this->renderPartial('_producto_catalogo', array('id' => $id, 'producto' => $producto));
			}
		?>
		</div>
	</div>
</div>
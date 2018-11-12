<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
<?php echo "?>\n"; ?>

<?php
	function tabs($string, $tabs){
		$aux = "";
		for($i = 0; $i < $tabs; $i++){
			$aux = $aux . "\t";
		}
		return $aux.$string;
	}
	
	echo "\t<div class=\"col-sm-12\">\n";
	echo "\t\t<div class=\"card\">\n";
	echo "\t\t\t<div class=\"card-header\">\n";
	echo "\t\t\t\t<img alt=\"Bootstrap Image Preview\" src=\"<?php echo Yii::app()->request->baseUrl.'/images/view64.png' ?>\"/>\n";
	echo "\t\t\t</div>\n";
	echo "\t\t\t<div class=\"card-body\">\n";
	
	$tabs = 4;
	echo tabs("<table class=\"table\">\n", $tabs);
	
	foreach($this->tableSchema->columns as $column)
	{
		if($column->name == 'id')
			continue;
		echo tabs("<tr>\n", ++$tabs);
		echo tabs("<th scope=\"row\"><?php echo \$data->getAttributeLabel('{$column->name}') ?></th>\n", ++$tabs);
		echo tabs("<td><?php echo \$data->{$column->name} ?></th>\n", $tabs);
		echo tabs("</tr>\n", --$tabs);
		--$tabs;
	}	
	
	echo tabs("</table>\n", $tabs);
	echo tabs("<?php echo CHtml::button('Editar', array('onclick' => 'js:document.location.href=\"'. Yii::app()->request->baseUrl . '/index.php/{$this->controller}/default/editar/id/' . \$data->id .'\"', 'class' => 'btn btn-primary')); ?>\n", $tabs);
	echo tabs("<?php echo CHtml::button('Eliminar', array('onclick' => 'js:document.location.href=\"'. Yii::app()->request->baseUrl . '/index.php/{$this->controller}/default/eliminar/id/' . \$data->id .'\"', 'class' => 'btn btn-primary')); ?>\n", $tabs);
	echo tabs("<?php echo CHtml::button('Lista de {$this->controller}', array('onclick' => 'js:document.location.href=\"'. Yii::app()->request->baseUrl . '/index.php/{$this->controller}/default/lista\"', 'class' => 'btn btn-primary')); ?>\n", $tabs);
	
	echo "\t\t\t</div>\n";
	echo "\t\t</div>\n";
	echo "\t</div>\n";
	
	//echo print_r($this, true);

?>

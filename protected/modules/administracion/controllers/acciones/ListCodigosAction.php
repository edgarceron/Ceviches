<?php
class ListCodigosAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        if(isset($_GET['codigo'])){
			$codigo = $_GET['codigo'];
		}
		else{
			$codigo = '';
		}
		
		if(isset($_GET['tipo'])){
			$tipo = $_GET['tipo'];
		}
		else{
			$tipo = '';
		}
		
		if(isset($_GET['minimo'])){
			$minimo = $_GET['minimo'];
		}
		else{
			$minimo = '';
		}
		
		if(isset($_GET['maximo'])){
			$maximo = $_GET['maximo'];
		}
		else{
			$maximo = '';
		}
		
		if(isset($_GET['validez'])){
			$validez = $_GET['validez'];
		}
		else{
			$validez = '';
		}

		
		$model = new CodigosPromocionales;
		$criteria = new CDbCriteria;
		$criteria->addCondition('codigo LIKE "%'. $codigo . '%"');
		$criteria->compare('tipo', $tipo);
		
		if($minimo == ''){
			$min = -1;
		}
		else{
			$min = $minimo;
		}
		
		if($maximo == ''){
			$max = 1000000000;
		}
		else{
			$max = $maximo;
		}
		
		$criteria->addCondition('valor >= ' . $min . ' AND valor <= ' . $max);
		if($validez != '')
			$criteria->addCondition('valido_desde <= "' . $validez . '" AND valido_hasta >= "' . $validez . '"');
		$reporte = new CActiveDataProvider($model, array('criteria' => $criteria));
		$errores = "";
		
		$tipos = CodigosPromocionales::getTipos();
		$tipos[''] = "Cualquier tipo";
		ksort($tipos);

        $this->controller->render('lista_codigos',array(
			'codigo' => $codigo,
			'tipo' => $tipo,
			'minimo' => $minimo,
			'maximo' => $maximo,
			'validez' => $validez,
			'tipos' => $tipos,
			'errores' => $errores,
			'dataProvider' => $reporte,
        ));
    }
}


<?php

class DefaultController extends Controller
{
	public function beforeAction($action) 
	{
		$modulo = $this->module->id;
		$cri_val = new CDbCriteria();
		$cri_val->compare('id', $modulo);
		$verificar = Modulos::model()->find($cri_val);
		if(empty($verificar))
		{
			$record = new Modulos;
			$record->id = $modulo; 
			$record->nombre = $modulo;
			$record->estado = 1;
			$record->fecha_creacion = time();
			$record->version = 1;
			$record->desarrollador = "edgar.ceron@correounivalle.edu.co";
			$record->save();
		}
		
		$acciones = Yii::app()->getController()->actions();
		
		foreach($acciones as $clave => $valor)    
		{
			$cri_val = new CDbCriteria();
			$cri_val->compare('modulo', $modulo);
			$cri_val->compare('accion', $clave);
			$verificar = Acciones::model()->find($cri_val);
			if(empty($verificar))
			{
				$validacion = new Acciones;
				$validacion->modulo = $modulo;
				$validacion->accion = $clave;
				$validacion->ruta = $valor;
				$validacion->save();
			}                    
			DefaultController::crearPermisos($modulo, $clave);
		}
		return true;
	}
	
	public static function crearPermisos($modulo, $accion){
		if(!DefaultController::existePermiso($modulo, $accion)){
			$perfil = 1;
			$estado = 1;
			$record = new PerfilContenido;
			$record->modulo = $modulo;
			$record->controlador = $modulo;
			$record->accion = $accion;
			$record->estado = $estado;
			$record->perfil = $perfil;
			$record->fecha_creacion = time();	
			if($record->save()){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return true;
		}	
	}

	public static function existePermiso($modulo, $accion){
		$perfil = 1;
		$estado = 1;
		$criteria = new CDbCriteria();            
		$criteria->compare('perfil', $perfil);
		$criteria->compare('estado', $estado);
		$criteria->compare('modulo', $modulo);
		$criteria->compare('accion', $accion);
		$permisos = PerfilContenido::model()->find($criteria);
		if(count($permisos) == 1){
			return true;
		}
		return false;
    }
        
    public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
        
	public function actions()
	{
		return array(
			'index'=>'application.modules.'.$this->module->id.'.controllers.acciones.IndexAction',                            
			'form'=>'application.modules.'.$this->module->id.'.controllers.acciones.FormAction',                            
			'addTipoVariable'=>'application.modules.'.$this->module->id.'.controllers.acciones.AddTipoVariableAction',                            
		);
	}
        
    public function accessRules()
	{
		return array(	
                        				
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('index'),
                                'expression' => array(__CLASS__,'allowIndex'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('form'),
                                'expression' => array(__CLASS__,'allowForm'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('addTipoVariable'),
                                'expression' => array(__CLASS__,'allowAddTipoVariable'),
                            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
			
		);
	}
        
    public static function allowIndex()
	{
		/*
		$accion = 'index'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'productos';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		*/
		return true;
	}
	
	public static function allowForm()
	{
		/*
		$accion = 'formulario'; 
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'productos';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		*/
		return true;
	}
	
	public static function allowAddTipoVariable()
	{
		/*
		$accion = 'addTipoVariable'; 
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'productos';
			$criteria->compare('perfil', $usuario->perfil);
			$criteria->compare('modulo', $modulo);
			$criteria->compare('accion', $accion);
			$permisos = PerfilContenido::model()->find($criteria);
			if(count($permisos) == 1)
			{
				$criteria_log = new CDbCriteria();
				$criteria_log->compare('modulo', $modulo);
				$criteria_log->compare('accion', $accion); 
				$accion_log = Acciones::model()->find($criteria_log);
				$log = new Logs;
				$log->accion = $accion_log->id;
				$log->usuario = Yii::app()->user->id;
				$log->save();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
		*/
		return true;
	}
	
}
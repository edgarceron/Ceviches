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
			'formulario'=>'application.modules.'.$this->module->id.'.controllers.acciones.FormularioAction',                            
			'addItem'=>'application.modules.'.$this->module->id.'.controllers.acciones.AddItemAction',                            
			'cargarCarrito'=>'application.modules.'.$this->module->id.'.controllers.acciones.CargarCarritoAction', 
			'carrito'=>'application.modules.'.$this->module->id.'.controllers.acciones.CarritoAction', 
			'cambiarCantidad'=>'application.modules.'.$this->module->id.'.controllers.acciones.CambiarCantidadAction', 
			'deleteItem'=>'application.modules.'.$this->module->id.'.controllers.acciones.DeleteItemAction', 
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
                                'actions' => array('formulario'),
                                'expression' => array(__CLASS__,'allowFormulario'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('addItem'),
                                'expression' => array(__CLASS__,'allowAddItem'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('cargarCarrito'),
                                'expression' => array(__CLASS__,'allowCargarCarrito'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('carrito'),
                                'expression' => array(__CLASS__,'allowCarrito'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('cambiarCantidad'),
                                'expression' => array(__CLASS__,'allowCambiarCantidad'),
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('deleteItem'),
                                'expression' => array(__CLASS__,'allowDeleteItem'),
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
			$modulo = 'tienda';
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
	
	public static function allowFormulario()
	{
		/*
		$accion = 'formulario'; 
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'tienda';
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
	
	public static function allowAddItem()
	{
		/*
		$accion = 'index'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'tienda';
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
	
	public static function allowCargarCarrito()
	{
		/*
		$accion = 'index'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'tienda';
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
	
	public static function allowCarrito()
	{
		/*
		$accion = 'index'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'tienda';
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
	
	public static function allowDeleteItem()
	{
		/*
		$accion = 'index'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'tienda';
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
	
	public static function allowCambiarCantidad()
	{
		/*
		$accion = 'index'; //Cambiar esto cada ves que lo copie para una accion diferente
		if(Yii::app()->user->name != "Guest"){
			$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
			$criteria = new CDbCriteria();            
			$modulo = 'tienda';
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
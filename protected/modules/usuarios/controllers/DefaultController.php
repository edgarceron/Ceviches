<?php

class DefaultController extends Controller
{
        public function beforeAction() 
        {
            
             $acciones = Yii::app()->getController()->actions();
             

                foreach($acciones as $clave => $valor)    
                {
                    $cri_val = new CDbCriteria();
                    $cri_val->compare('modulo', $this->module->id);
                    $cri_val->compare('accion', $clave);
                    $verificar = Acciones::model()->find($cri_val);
                    if(empty($verificar))
                    {
                        $validacion = new Acciones;
                        $validacion->modulo = $this->module->id;
                        $validacion->accion = $clave;
                        $validacion->ruta = $valor;
                        $validacion->save();
                    }                    
                    
                }
                return true;
        }
    
        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations			
		);
	}
        
        public function actions()
        {
            return array(                
                'index'=>'application.modules.'.$this->module->id.'.controllers.acciones.IndexAction',
                'view'=>'application.modules.'.$this->module->id.'.controllers.acciones.ViewAction',
                'create'=>'application.modules.'.$this->module->id.'.controllers.acciones.CreateAction',
                'borrar'=>'application.modules.'.$this->module->id.'.controllers.acciones.BorrarAction',
                'perfil'=>'application.modules.'.$this->module->id.'.controllers.acciones.PerfilAction',
                'verperfil'=>'application.modules.'.$this->module->id.'.controllers.acciones.VerperfilAction',
                'borrarperfil'=>'application.modules.'.$this->module->id.'.controllers.acciones.BorrarperfilAction',
                'grupo'=>'application.modules.'.$this->module->id.'.controllers.acciones.GrupoAction',
                'restablecer'=>'application.modules.'.$this->module->id.'.controllers.acciones.RestablecerAction',	
                'nuevaContra'=>'application.modules.'.$this->module->id.'.controllers.acciones.NuevaContraAction',	
                'recuperar'=>'application.modules.'.$this->module->id.'.controllers.acciones.RecuperarAction',	
                'cambiar'=>'application.modules.'.$this->module->id.'.controllers.acciones.CambiarAction',	
                'cuenta'=>'application.modules.'.$this->module->id.'.controllers.acciones.CuentaAction',	
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
                                'actions' => array('view'),
                                'expression' => array(__CLASS__,'allowView'),
                            ), 
                    array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('create'),
                                'expression' => array(__CLASS__,'allowCreate'),
                            ), 
                    array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('borrar'),
                                'expression' => array(__CLASS__,'allowBorrar'),
                            ), 
                    array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('perfil'),
                                'expression' => array(__CLASS__,'allowPerfil'),
                            ), 
                    array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('verperfil'),
                                'expression' => array(__CLASS__,'allowVerperfil'),
                            ), 
                    array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('borrarperfil'),
                                'expression' => array(__CLASS__,'allowBorrarperfil'),
                            ), 
                    array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('grupo'),
                                'expression' => array(__CLASS__,'allowGrupo'),
                            ),
					array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('restablecer'),
                                'expression' => array(__CLASS__,'allowRestablecer'),
                            ),
					array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('nuevaContra'),
                                'expression' => array(__CLASS__,'allowNuevaContra'),
                            ),
					array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('recuperar'),
                                'expression' => array(__CLASS__,'allowRecuperar'),
                            ),
					array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('cambiar'),
                                'expression' => array(__CLASS__,'allowCambiar'),
                            ),
					array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('cuenta'),
                                'expression' => array(__CLASS__,'allowCuenta'),
                            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
			
		);
	}
        
        public function allowIndex()
	{
            if(Yii::app()->user->name != "Guest"){
                $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
                $criteria = new CDbCriteria();            
                $modulo = 'usuarios';
                $criteria->compare('perfil', $usuario->perfil);
                $criteria->compare('modulo', $modulo);
                $criteria->compare('accion', 'index');
                $permisos = PerfilContenido::model()->find($criteria);
                if(count($permisos) == 1)
                {
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
        }                                      
        
        public function allowView()
	{
            if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
            $criteria = new CDbCriteria();            
            $modulo = 'usuarios';
            $criteria->compare('perfil', $usuario->perfil);
            $criteria->compare('modulo', $modulo);
            $criteria->compare('accion', 'view');
            $permisos = PerfilContenido::model()->find($criteria);
            if(count($permisos) == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
            }
        } 
        
        public function allowCreate()
	{
            if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
            $criteria = new CDbCriteria();            
            $modulo = 'usuarios';
            $criteria->compare('perfil', $usuario->perfil);
            $criteria->compare('modulo', $modulo);
            $criteria->compare('accion', 'create');
            $permisos = PerfilContenido::model()->find($criteria);
            if(count($permisos) == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
            }
        } 
        
        public function allowBorrar()
	{
            if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
            $criteria = new CDbCriteria();            
            $modulo = 'usuarios';
            $criteria->compare('perfil', $usuario->perfil);
            $criteria->compare('modulo', $modulo);
            $criteria->compare('accion', 'borrar');
            $permisos = PerfilContenido::model()->find($criteria);
            if(count($permisos) == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
            }
        } 
        
        public function allowPerfil()
	{
            if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
            $criteria = new CDbCriteria();            
            $modulo = 'usuarios';
            $criteria->compare('perfil', $usuario->perfil);
            $criteria->compare('modulo', $modulo);
            $criteria->compare('accion', 'perfil');
            $permisos = PerfilContenido::model()->find($criteria);
            if(count($permisos) == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
            }
        } 
        
        public function allowVerperfil()
	{
            if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
            $criteria = new CDbCriteria();            
            $modulo = 'usuarios';
            $criteria->compare('perfil', $usuario->perfil);
            $criteria->compare('modulo', $modulo);
            $criteria->compare('accion', 'verperfil');
            $permisos = PerfilContenido::model()->find($criteria);
            if(count($permisos) == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
            }
			
        } 
        
        public function allowBorrarperfil()
	{
            if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
            $criteria = new CDbCriteria();            
            $modulo = 'usuarios';
            $criteria->compare('perfil', $usuario->perfil);
            $criteria->compare('modulo', $modulo);
            $criteria->compare('accion', 'borrarperfil');
            $permisos = PerfilContenido::model()->find($criteria);
            if(count($permisos) == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
            }
        } 
        
    public function allowGrupo()
	{
        if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
            $criteria = new CDbCriteria();            
            $modulo = 'usuarios';
            $criteria->compare('perfil', $usuario->perfil);
            $criteria->compare('modulo', $modulo);
            $criteria->compare('accion', 'grupo');
            $permisos = PerfilContenido::model()->find($criteria);
            if(count($permisos) == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    } 
	
	public function allowRestablecer()
	{
        if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
            $criteria = new CDbCriteria();            
            $modulo = 'usuarios';
            $criteria->compare('perfil', $usuario->perfil);
            $criteria->compare('modulo', $modulo);
            $criteria->compare('accion', 'restablecer');
            $permisos = PerfilContenido::model()->find($criteria);
            if(count($permisos) == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    } 
	
	public function allowCambiar()
	{
        if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
            $criteria = new CDbCriteria();            
            $modulo = 'usuarios';
            $criteria->compare('perfil', $usuario->perfil);
            $criteria->compare('modulo', $modulo);
            $criteria->compare('accion', 'cambiar');
            $permisos = PerfilContenido::model()->find($criteria);
            if(count($permisos) == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
	
	public function allowCuenta()
	{
        if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id);
            $criteria = new CDbCriteria();            
            $modulo = 'usuarios';
            $criteria->compare('perfil', $usuario->perfil);
            $criteria->compare('modulo', $modulo);
            $criteria->compare('accion', 'cuenta');
            $permisos = PerfilContenido::model()->find($criteria);
            if(count($permisos) == 1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
    
	public function allowNuevaContra()
	{
		return true;
	}
	
	public function allowRecuperar()
	{
		return true;
	}
}
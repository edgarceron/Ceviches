<?php

class SiteController extends Controller
{
        public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
        
        public function accessRules()
	{
		return array(	
                array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('error','login','logout', 'register', 'loginregister','index'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('contact'),
				'users'=>array('@'),
			),	
			/*array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('admin'),
                                'expression' => array('SofintAgendaController','allowAdmin')
                            ),
			array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('view','index'),
                                'expression' => array('SofintAgendaController','allowView')
                            ),
                        array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('create'),
                                'expression' => array('SofintAgendaController','allowCreate')
                            ),
                        array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('update','updatecalendar'),
                                'expression' => array('SofintAgendaController','allowUpdate')
                            ),
                        array('allow', // allow only the owner to perform 'view' 'update' 'delete' actions
                                'actions' => array('delete'),
                                'expression' => array('SofintAgendaController','allowDelete')
                            ),*/
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$id = Yii::app()->user->id;
		$user = SofintUsers::model()->findByPk($id);
		if($user != null){
			$perfil = $user['perfil'];
			if($perfil == 1){
				$url = Yii::app()->createAbsoluteUrl('/administracion/');
			}
			else{
				$url = Yii::app()->createAbsoluteUrl('/tienda/');
			}
		}
		else{
			$url = Yii::app()->createAbsoluteUrl('/tienda/');
		}
		$this->redirect($url);
	}
	
	public function ActionLoginregister(){
		$this->render('loginregister',array());
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$user_name = Yii::app()->user->name;
		if($user_name == "Guest"){
			$model=new LoginForm;

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
				{
					Logs::logcreate(0);
					$id = Yii::app()->user->id;
					$user = SofintUsers::model()->findByPk($id);
					$restablecer = $user['restablecer'];
					if($restablecer == 1){
						$this->redirect(Yii::app()->createAbsoluteUrl('/usuarios/default/nuevaContra') . "?id=$id");
					}
					else{
						$this->redirect(Yii::app()->user->returnUrl);
					}
				}				
			}
			// display the login form
			$this->render('login',array('model'=>$model));
		}
		else{
			$url = Yii::app()->createAbsoluteUrl('');
			$this->redirect($url);
		}
	}
	
	/**
	 * Displays the login page
	 */
	public function actionRegister()
	{
		$user_name = Yii::app()->user->name;
		if($user_name == "Guest"){
			$model=new SofintUsers;

			// collect user input data
			if(isset($_POST['SofintUsers']))
			{
				$model->setAttributes($_POST['SofintUsers']);
				$password = $model->password;
				$cpassword = $_POST['confirmar'];
				$email = $model->nick;
				$repetido = SofintUsers::model()->find('nick = "' . $email . '"');
				$errors = false;
				if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $repetido){	
					$model->nick = '';
				}
				
				if($password == $cpassword){
					$model->password = md5($password);
				}
				else{
					$model->password = null;
				}
				
				$model->estado = 1;
				$model->perfil = 2;
				$model->fecha_creacion = time();
				
				if($model->save())
				{
					$nombre = $model->nombre;
					Yii::app()->user->setFlash('success', "Usuario creado exitosamente!");
					$identity=new UserIdentity($email,$password);
					$identity->authenticate();
					$duration = 3600;
					if($identity->errorCode===UserIdentity::ERROR_NONE)
					{
						Yii::app()->user->login($identity,$duration);
					}
					$this->redirect(Yii::app()->createAbsoluteUrl('/usuarios/default/notificarRegistro', array('mail' => $email, 'nombre' => $nombre)));
				}   
				else
				{
					Yii::app()->user->setFlash('warning', "Informacion Incorrecta, verifique nuevamente!");
					$model->nick = $email;
					
					if($password == ''){
						$model->clearErrors('password');
						$model->addError('password', 'Contraseña no puede estar vacia');
					}
					
					if($password != $cpassword){
						$model->clearErrors('password');
						$model->addError('password', 'Las contraseñas no coinciden');
					}	
					if(!filter_var($email, FILTER_VALIDATE_EMAIL)){	
						$model->clearErrors('nick');
						$model->addError('nick', 'El correo electronico ingresado no es valido, verifique nuevamente');
					}
					if($repetido){
						$model->clearErrors('nick');
						$model->addError('nick', 'Ya existe un usuario registrado con el correo ingresado');
					}
					$this->render('register',array('model'=>$model));
				}
			}
			else{
				$this->render('register',array('model'=>$model));
			}
		}
		else{
			$url = Yii::app()->createAbsoluteUrl('');
			$this->redirect($url);
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
        Logs::logcreate(-1);
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
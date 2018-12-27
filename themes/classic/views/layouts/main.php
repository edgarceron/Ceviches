<?php /* @var $this Controller */ ?>
<?php  
        $tipo = 0;
        if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id); 
            $tipo = $usuario->estado;
			$perfil = $usuario->perfil;
        }   
		
		$home_url = Yii::app()->createUrl('');
		
		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="h-100" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
                  
    <!-- Bootstrap core CSS -->        

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">   
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" /> 

	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
 
<body class="d-flex flex-column h-100" cz-shortcut-listen="true">
<main role="main" class="flex-shrink-0">
	<header class="navbar navbar-expand-lg navbar-light bg-light" style="z-index: 4; position:sticky; top:0">
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<a class="navbar-brand" href="<?php echo $home_url; ?>">
				<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_ceviche_y_mar.png" width="100" height="100" class="d-inline-block align-top" alt="">
			</a>
			<ul class="navbar-nav mr-auto">
			<!--
			<?php 
				foreach(array_keys(Yii::app()->modules) as $modulos){                                               
					if($modulos != "gii"){
						$info_modulo = Modulos::model()->findByPk($modulos);  
						if(!empty($info_modulo)){
							$padre_p = Yii::app()->getModule($modulos)->padre;
							$version_p = Yii::app()->getModule($modulos)->version;
							$estado_p = $info_modulo->estado;
							$nombre_p = Yii::app()->getModule($modulos)->nombre;
							if(Yii::app()->getModule($modulos)->desplegable){
								$url = '#';
							}
							else{
								$url = Yii::app()->createUrl($modulos);
							}
							if($padre_p == "" && $version_p != 0 && $estado_p != 0){
								?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="<?php echo $url; ?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<?php echo $nombre_p ?>
									</a>	
									
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<?php
								
								foreach(array_keys(Yii::app()->modules) as $hijo){
									if($hijo == 'gii') continue;
									$info_hijo = Modulos::model()->findByPk($modulos);  
									if(!empty($info_hijo)){
											$padre_h = Yii::app()->getModule($hijo)->padre;
										$version_h = Yii::app()->getModule($hijo)->version;
										$estado_h = $info_hijo->estado;
										$nombre_h = Yii::app()->getModule($hijo)->nombre;
										
										if($padre_h == $modulos && $estado_h != 0){
											?>
												<a class="dropdown-item" href="<?php echo Yii::app()->createUrl($hijo) ?>"><?php echo $nombre_h ?></a>
											<?php
										}
									}	
								}
								
								?>
									</div>
								</li>
								<?php
							}
						}
					}
				}
			?> -->
				
			</ul>	
			<ul class="navbar-nav ml-sm-2">
				<li class="nav-item">
					<?php
						$nombre = '';
						if(!(Yii::app()->user->name == "Guest")) {
							$user = SofintUsers::model()->findByPk(Yii::app()->user->id);
							$nombre = $user->nombre;
							echo '<span class="navbar-text">Bienvenido ' . $nombre . '</span>';
						}
					?>
				</li>
			</ul>
		</div>
		<div class="navbar navbar-expand-lg">
			<?php
				if(isset($usuario)) {
					$criteria = new CDbCriteria;
					$criteria->compare('perfil', $perfil);
					$criteria->compare('modulo', 'administracion');
					$criteria->compare('accion', 'cargarNotificaciones');
					$permiso = PerfilContenido::model()->find($criteria);
					if($permiso != null){
						
					
			?>
			<ul class="navbar-nav ml-sm-3">
				<li class="nav-item dropdown">
					<a class="nav-item nav-link dropdown-toggle" href="#" id="navbarNotification" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/bell32.png">
					</a>
					<div style="position: absolute; bottom: 1px; right: 8px;">
						<span class="badge badge-danger" id="numeroNotificaciones">0</span>
					</div>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarNotification" style="position:absolute; overflow-y: scroll; max-height:700%" id = "notificaciones">
						No hay notificaciones para mostrar
					</div>
				</li>
			</ul>
			<?php
					}
				}
			?>
			<ul class="navbar-nav ml-sm-2">
				
				<li class="nav-item dropdown">
					<a class="nav-item nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/user32.png">
					</a>
					
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="position:absolute">
					<?php if(Yii::app()->user->name == "Guest") { ?>
						<a class="dropdown-item" href="<?php echo Yii::app()->createUrl("/site/login") ?>">Ingresar</a>
						<a class="dropdown-item" href="<?php echo Yii::app()->createUrl("/site/register") ?>">Registrarse</a>
					<?php }else{ ?>
						<a class="dropdown-item" href="<?php echo Yii::app()->createUrl("/site/logout") ?>">Logout(<?php echo $nombre ?>)</a>
						<a class="dropdown-item" href="<?php echo Yii::app()->createUrl('/usuarios/default/cuenta',array('id'=>Yii::app()->user->id)) ?>">Mi Cuenta</a>
						<!-- <a class="dropdown-item" href="<?php echo Yii::app()->createUrl("/usuarios") ?>">Configuracion</a> -->
					<?php } ?>
					</div>
				</li>
			</ul>
		
			<?php
			if(Yii::app()->user->name != "Guest" && $perfil != 1){
			?>
			<ul class="navbar-nav ml-sm-3">
				<li class="nav-item dropdown">
					<a class="nav-item nav-link dropdown-toggle" href="#" id="navbarCart" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cart32.png">
					</a>
					<div class="dropdown-menu dropdown-menu-right table-responsive-md" aria-labelledby="navbarCart" style="min-width: 20rem;" id = "carrito">
						No hay productos para mostrar
					</div>
				</li>
			</ul>
			<?php
			}
			?>
		</div>
	</header>
	<div id="mensaje_carrito" class="collapse alert alert-success" role="alert" style="position:fixed; z-index:1000; top:130px; right:10px ; width:50%; float:none">
		
	</div>
	
	<?php if(isset($this->breadcrumbs)):?>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">  
			<li class="breadcrumb-item active"><a href="<?php echo Yii::app()->createUrl('tienda'); ?>">Home</a></li>  
			<!--
			<?php if(isset($this->breadcrumbs[0]) && isset($this->breadcrumbs[1])) { ?>
			<li class="breadcrumb-item active"><a href="<?php echo Yii::app()->createUrl($this->breadcrumbs[0]) ?>"><?php echo $this->breadcrumbs[1] ?></a></li>            
			<?php } ?> -->
		</ol>
	</nav>
	
	<?php
		foreach(Yii::app()->user->getFlashes() as $key => $message) 
		{            
			echo '<div class="alert alert-'.$key.' alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					'.$message.'.
				 </div>';
		}
	?>
	
	<?php endif?>
	
	<div class="container">
		<?php echo $content ?>
	</div>
</main>
	
	<footer class="footer mt-auto py-3 bg-light">
		<div class="container bg-light">
			<div class="row">
				<div class="col-md-4">
					<h4>Acerca de C&M </h4>
					<audio preload="none" src="<?php echo Yii::app()->request->baseUrl."/sounds/notification.mp3" ?>" style="width: 100%;" id="audioNotificacion"></audio>
				</div>
				<div class="col-md-4">
					<h4>Servicio al cliente</h3>
				</div>
				<div class="col-md-4">
					<h4>Redes sociales </h4>
				</div>
			</div>
		</div>
	</footer>
	<script>
	function cargarCarrito(){
		<?php 	
		echo CHtml::ajax(
			array(
				'type'=>'GET',
				'dataType'=>'html',
				'async'=>'false',
				'url' => Yii::app()->createAbsoluteUrl('/tienda/default/cargarCarrito'),
				'update'=>'#carrito',
			)
		); ?>
	}
	<?php
		if(isset($usuario)) {
			if($permiso != null){
	?>
	
	function cargarNotificaciones(){
		jQuery.ajax({
			'type':'GET',
			'dataType':'html',
			'async':false,
			'url':'<?php echo Yii::app()->createAbsoluteUrl('/administracion/default/cargarNotificaciones') ?>',
			'cache':false,
			'data':jQuery(this).parents("form").serialize(),
			'success':function(pizza){
				var porciones = pizza.split('--');
				var html = porciones[0];
				var numero = porciones[1];
				if(numero > 0){
					var sound = document.getElementById("audioNotificacion"); 
					sound.play(); 
				}
				jQuery("#notificaciones").html(html);
				jQuery("#numeroNotificaciones").html(numero);
			}
		});	
	}
	<?php
			}
		}
	?>
	function notificacionesDinamico(){
		setTimeout( function(){ cargarNotificaciones(); notificacionesDinamico()}, 10000);
	}
	
	window.onload = function() {
		<?php
		if(isset($usuario)) {
			
			if($permiso != null){
		?>
		cargarNotificaciones();
		<?php
				}
			}
		?>
		cargarCarrito();
		notificacionesDinamico();
	}
	</script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>              
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.PrintArea.js"></script>
	
</body>
	
</html>

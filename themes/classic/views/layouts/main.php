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
	<!-- Google Analytics -->
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-125725981-2', 'auto', {'allowLinker': true});
	ga('require', 'linker');
	ga('require', 'ec');
	ga('linker:autoLink', ['https://www.cevicheymar.com, https://www.cevicheymar.com/Ceviches/index.php/tienda']);
	ga('require', 'displayfeatures');
	ga('send', 'pageview');
	</script>
	<!-- End Google Analytics -->
	
	<!-- Google Tag Manager -->
	<script>
	(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-T56F5K4');
	</script>
	<!-- End Google Tag Manager -->

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">           
    <!-- Bootstrap core CSS -->        
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/hover.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/theme.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">   
	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css" rel="stylesheet" type="text/css" /> 

	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	

</head>
 
<body class="d-flex flex-column h-100" cz-shortcut-listen="true">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T56F5K4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<audio preload="none" src="<?php echo Yii::app()->request->baseUrl."/sounds/notification.mp3" ?>" style="width: 100%;" id="audioNotificacion"></audio>
<main role="main" class="flex-shrink-0">
	<header class="navbar navbar-expand-lg navbar-light bg-light" style="z-index: 4; position:sticky; top:0">
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
			
		</div>
		<div class="navbar navbar-expand-lg">
			<?php
				if(isset($usuario)) {
					$criteria = new CDbCriteria;
					$criteria->compare('perfil', $perfil);
					$criteria->compare('modulo', 'administracion');
					$criteria->compare('accion', 'cargarNotificaciones');
					$notificaciones = PerfilContenido::model()->find($criteria);
					if($notificaciones != null){
						
					
			?>
			<ul class="navbar-nav ml-sm-3">
				<?php
					$criteria = new CDbCriteria;
					$criteria->compare('perfil', $perfil);
					$criteria->compare('modulo', 'administracion');
					$criteria->compare('accion', 'opciones');
					$permiso = PerfilContenido::model()->find($criteria);
					if($permiso != null){
				?>
				<li class="nav-item dropdown">
					<a class="nav-item nav-link dropdown-toggle" href="#" id="navbarNotificationPreparando" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/gear32.png">
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarNotificationPreparando" style="position:absolute; overflow-y: scroll; max-height:700%" id = "notificacionesPreparando">
						<a class="dropdown-item" href="<?php echo Yii::app()->createUrl("/administracion/default/opciones") ?>">Opciones administrativas</a>
					</div>
				</li>
				<?php
					}
				?>
				<li class="nav-item dropdown">
					<a class="nav-item nav-link dropdown-toggle" href="#" id="navbarNotificationPreparando" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/bell32.png">
					</a>
					<div style="position: absolute; bottom: 1px; right: 8px;">
						<span class="badge badge-success" id="numeroNotificacionesPreparando">0</span>
					</div>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarNotificationPreparando" style="position:absolute; overflow-y: scroll; max-height:700%" id = "notificacionesPreparando">
						No hay notificaciones para mostrar
					</div>
				</li>
				
				<li class="nav-item dropdown">
					<a class="nav-item nav-link dropdown-toggle" href="#" id="navbarNotificationRecibido" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/bell32.png">
					</a>
					<div style="position: absolute; bottom: 1px; right: 8px;">
						<span class="badge badge-danger" id="numeroNotificacionesRecibido">0</span>
					</div>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarNotificationRecibido" style="position:absolute; overflow-y: scroll; max-height:700%" id = "notificacionesRecibido">
						No hay notificaciones para mostrar
					</div>
				</li>
			</ul>
			<?php
					}
				}
			?>
			<ul class="navbar-nav ml-sm-2">
				<li class="nav-item">
					<?php
						$nombre = '';
						if(!(Yii::app()->user->name == "Guest")) {
							$user = SofintUsers::model()->findByPk(Yii::app()->user->id);
							$nombre = $user->nombre;
							echo '<span class="navbar-text">Bienvenido&nbsp</span><span class="navbar-text bienvenido">' . $nombre . '</span>';
						}
					?>
				</li>
			</ul>
			
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
			if(Yii::app()->user->name == "Guest" || $perfil != 1){
			?>
			<ul class="navbar-nav ml-sm-3">
				<li class="nav-item dropdown">
					<a class="nav-item nav-link dropdown-toggle" href="#" id="navbarCart" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/cart32.png">
					</a>
					<div style="position: absolute; bottom: 1px; right: 8px;">
						<span class="badge badge-success" id="numeroItemsCarrito">0</span>
					</div>
					<div class="dropdown-menu dropdown-menu-right table-responsive-md" aria-labelledby="navbarCart" style="position:absolute; min-width: 20rem;  height: 700%;" id = "carrito">
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
			<li class="breadcrumb-item active"><a href="<?php echo Yii::app()->createUrl(''); ?>">Home</a></li>  
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
				
					<div class="wpb_column column_container col-sm-4">
						<div class="vc_column-inner ">
							<div class="wpb_wrapper">
								<div class="custom-information  ">
									<div class="footer-box">
										<h2 class="title14 font-bold color-base text-uppercase poppins-font">ACERCA DE C&amp;M</h2>
										<a class="color-base1" href="https://cevicheymar.com/nosotros/"><i class="white fa fa fa-home" aria-hidden="true"></i> Nosotros</a><br>
										<a class="color-base1" href="https://cevicheymar.com/politica-tratamiento-de-datos/"><i class="white fa fa-mobile" aria-hidden="true"></i> Política de tratamiento de datos</a>
									</div>

								</div>
							</div>
						</div>
					</div>
					
					<div class="wpb_column column_container col-sm-4">
						<div class="vc_column-inner ">
							<div class="wpb_wrapper">
								<div class="custom-information  ">
									<div class="footer-box">
										<h2 class="title14 font-bold color-base text-uppercase poppins-font">SERVICIO AL CLIENTE</h2>
										<a class="color-base1" href="https://cevicheymar.com/preguntas-frecuentes/"><i class="white fa fa-question-circle" aria-hidden="true"></i> Preguntas Frecuentes</a><br>
										<a class="color-base1" href="https://cevicheymar.com/contact/"><i class="white fa fa-wpforms" aria-hidden="true"></i> Contacto</a>
									</div>

								</div>
							</div>
						</div>
					</div>
					
					<div class="footer-box wpb_column column_container col-sm-4">
						<div class="vc_column-inner ">
							<div class="wpb_wrapper">
								<div class="custom-information  ">
									<h2 class="title14 font-bold color-base text-uppercase poppins-font">REDES SOCIALES</h2>

								</div>
								<ul class="social-network list-inline-block  ">
									<li><a class="float-shadow" href="https://www.facebook.com/cevicheymar/"><i class="fa fa-facebook"></i></a></li>
									<li><a class="float-shadow" href="https://www.instagram.com/cevicheymar/?hl=en"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="vc_row wpb_row vc_inner footer-copyright">
						<p class="copyright pull-left">© 2018. CevicheyMar. All Rights Reserved</p>
					</div>
			</div>
		</div>
	</footer>
	
	<script>
	function cargarCarrito(){
		jQuery.ajax({
			'type':'GET',
			'dataType':'html',
			'async':false,
			'url':'<?php echo Yii::app()->createAbsoluteUrl('/tienda/default/cargarCarrito/') ?>',
			'cache':false,
			'data':jQuery(this).parents("form").serialize(),
			'success':function(pizza){
				var porciones = pizza.split('--');
				var html = porciones[0];
				var numero = parseInt(porciones[1]);
				jQuery("#carrito").html(html);
				var n = "#numeroItemsCarrito";
				jQuery(n).html(numero);
			}});	
	}
	<?php
		if(isset($usuario)) {
			if($notificaciones != null){
	?>
	function cargarNotificaciones(tipo){
		jQuery.ajax({
			'type':'GET',
			'dataType':'html',
			'async':false,
			'url':'<?php echo Yii::app()->createAbsoluteUrl('/administracion/default/cargarNotificaciones/estado/') ?>' + "/" + tipo,
			'cache':false,
			'data':jQuery(this).parents("form").serialize(),
			'success':function(pizza){
				var porciones = pizza.split('--');
				var html = porciones[0];
				var numero = parseInt(porciones[1]);
				if(numero > 0 && tipo == 'Recibido'){
					var sound = document.getElementById("audioNotificacion"); 
					sound.play(); 
				}
				
				var n = "#notificaciones" + tipo;
				var nn = "#numeroNotificaciones" + tipo;
				jQuery(n).html(html);
				jQuery(nn).html(numero);
			}
		});	
	}
	
	function notificacionesDinamico(){
		setTimeout( function(){ cargarNotificaciones('Recibido'); cargarNotificaciones('Preparando'); notificacionesDinamico()}, 10000);
	}
	
	<?php
			}
		}
	?>
	
	
	window.onload = function() {
		<?php
		if(isset($usuario)) {
			
			if($notificaciones != null){
		?>
		cargarNotificaciones('Recibido');
		cargarNotificaciones('Preparando');
		notificacionesDinamico();
		<?php
				}
			}
		?>
		cargarCarrito();
		
	}
	</script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>              
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.PrintArea.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.doubleScroll.js"></script>
	
</body>
	
</html>

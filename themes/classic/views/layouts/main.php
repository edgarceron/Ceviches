<?php /* @var $this Controller */ ?>
<?php  
        $tipo = 0;
        if(Yii::app()->user->name != "Guest"){
            $usuario = SofintUsers::model()->findByPk(Yii::app()->user->id); 
            $tipo = $usuario->estado;
        }        
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
                    
        <meta name="description" content="Source code generated using layoutit.com">
        <meta name="author" content="LayoutIt!">
        <!-- Bootstrap core CSS -->        
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">   
            
        <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" /> 

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
 
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="#">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_ceviche_y_mar.png" width="100" height="100" class="d-inline-block align-top" alt="">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
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
			
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropleft">
					<?php
						$nombre = '';
						if(!(Yii::app()->user->name == "Guest")) {
							$user = SofintUsers::model()->findByPk(Yii::app()->user->id);
							$nombre = $user->nombre;
							echo '<span class="navbar-text">Bienvenido ' . $nombre . '</span>';
						}
					?>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-item nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/user32.png">
					</a>
					
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
			
		</div>
	</nav>
	
	<?php if(isset($this->breadcrumbs)):?>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">  
			<li class="breadcrumb-item active"><a href="<?php echo Yii::app()->createUrl(Yii::app()->defaultController); ?>">Home</a></li>  
			<!--
			<?php if(isset($this->breadcrumbs[0]) && isset($this->breadcrumbs[1])) { ?>
			<li class="breadcrumb-item active"><a href="<?php echo Yii::app()->createUrl($this->breadcrumbs[0]) ?>"><?php echo $this->breadcrumbs[1] ?></a></li>            
			<?php } ?> -->
		</ol>
	</nav>
	
	<?php
		foreach(Yii::app()->user->getFlashes() as $key => $message) 
		{            
			echo '<div class="alert alert-'.$key.' alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					'.$message.'.
				 </div>';
		}
	?>
	
	<?php endif?>
	
	<div class="container">
		<?php echo $content ?>
	</div>
	
	
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>              
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.PrintArea.js"></script>
	
</body>
	
</html>

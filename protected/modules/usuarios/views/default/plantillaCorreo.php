<html>
	<head>
	<title>Recordatorio de cita</title>
	</head>
	<body>
		<div style="background: none repeat scroll 0 0 #FDD828;
			font-family: arial;
			height: 25%;
			padding: 2%;
			text-align: center;
			width: 96%;">
			<h2><img src="<?php echo Yii::app()->request->baseUrl.'/images/logogrupo.png' ?>"/></h2>
		</div>
		<div style="background: none repeat scroll 0 0 #F1F2F2;
			font-family: arial;
			height: 30%;
			padding: 2%;
			text-align: center;
			width: 96%;">
			
				<h3>Recuperación de contraseña </h3>
				Sr. <?php echo $nombre; ?> </br>
				Usted solicito un cambio de contraseña desde el aplicativo de donaciones de la iglesia Nazareno </br>
				Ingerese a la siguiente url para proceder con la recuperación: </br>
				<?php echo $url; ?>
				
		</div>

	</body>
</html>
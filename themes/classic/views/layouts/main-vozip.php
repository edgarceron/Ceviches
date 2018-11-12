<?php /* @var $this Controller */ ?>
<?php  
$tipo = 0;
if(Yii::app()->user->name != "Guest"){
	$usuario = SofintUsers::model()->findByPk(Yii::app()->user->id); 
	$tipo = $usuario->estado;
}  

$fp = fopen("C:\\xampp2\htdocs\sofint_new_original\protected\data\config.txt", "r");
$linea = fgets($fp);
$datos = explode(';', $linea);
$servidor = $datos[0];
$puerto = $datos[1];
$usuario = $datos[2];
$contra = $datos[3];
fclose($fp);
$ruta = "https://$servidor:$puerto/";
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
    <style>
        a{
            color: #0783af !important;
        }
        a .btn-primary{
            color: #f8f5f0 !important;
        }
        .label-success {
            background-color: #0783af !important;
        }
    </style>
<body>
    
    <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<nav class="navbar" style="background-color: #f8f5f0" role="navigation">
				<div class="navbar-header">
					 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span></span><span class="icon-bar"></span><span class="icon-bar"></span>
                                        </button>
                                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo_tu_futuro_en_australia.png"/></a>
				</div>
				<table width="100%" cellspacing="0" cellpadding="2" class="menudescription">
          <tbody><tr>
            <td>
              <table cellspacing="2" cellpadding="4" border="0">
                <tbody><tr>
                                                      <td class="botonoff" title=""><a href="index.php?menu=agent_console">Consola de Agente</a></td>
                                                                        <td class="botonoff" title=""><a href="<?php echo $ruta; ?>index.php?menu=outgoing_calls">Llamadas Salientes</a></td>
                                                                        <td class="botonoff" title=""><a href="<?php echo $ruta; ?>index.php?menu=ingoing_calls">Llamadas Entrantes</a></td>
                                                                        <td class="botonoff" title=""><a href="<?php echo $ruta; ?>index.php?menu=agentoptions">Opciones de Agente</a></td>
                                                                        <td class="botonoff" title=""><a href="<?php echo $ruta; ?>index.php?menu=break_administrator">Recesos</a></td>
                                                                        <td class="botonoff" title=""><a href="<?php echo $ruta; ?>index.php?menu=forms">Formularios</a></td>
                                                                        <td class="botonoff" title=""><a class="submenu_on" href="<?php echo $ruta; ?>index.php?menu=reports_ingoing_call">Reportes</a></td>
                                                                        <td class="botonoff" title=""><a href="<?php echo $ruta; ?>index.php?menu=callcenter_config">Configuración</a></td>
                                                    </tr>
              </tbody></table>
            </td>
            </tr>
        </tbody></table>
				
			</nav>
			
		</div>
	</div>
      		
	
        
	<div class="container-fluid">
		<?php echo $content ?>
	</div>
        <hr/>
        <div class="col-lg-12 text-center" style="background-color: #f8f5f0;padding: 20px;" >
            <strong>Powered By <a href="http://www.grupoingsolutions.com" target="_blank">Grupo Ingenieros Solutions</a></strong><br/>
            <strong><?php echo date('Y') ?></strong>
        </div>
</div>

    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>    
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scripts.js"></script>              
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.PrintArea.js"></script>
   
    
</body>
</html>

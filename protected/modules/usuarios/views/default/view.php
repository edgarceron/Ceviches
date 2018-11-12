<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
        $this->module->nombre,
);
?>
    <ul class="nav nav-tabs" role="tablist">        
        <li class="nav-item active"><a href="#actualizar" aria-controls="actualizar" role="tab" data-toggle="tab" class="nav-link active"><span class="glyphicon glyphicon-refresh"></span> Actualizar</a></li>
        <li class="nav-item"><a href="#historico" aria-controls="historico" role="tab" data-toggle="tab" class="nav-link"><span class="glyphicon glyphicon-book"></span> Historial</a></li>        
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">              
        <div role="tabpanel" class="tab-pane active" id="actualizar">
            <?php echo $this->renderPartial('_form', array('model'=>$usuario)); ?>             
        </div>
        <div role="tabpanel" class="tab-pane" id="historico">
            <table class="table table-bordered">                            
                <thead>
                    <tr>
                        <th>Modulo</th>
                        <th>Accion</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
            <?php
                $command=Yii::app()->db->createCommand("select logs.accion as accion, sofint_users.nick as nick, acciones.modulo as modulo, acciones.accion as nombre_accion, logs.fecha as fecha from logs left join acciones on logs.accion = acciones.id left join sofint_users on logs.usuario = sofint_users.id where sofint_users.id = ".Yii::app()->user->id." order by logs.fecha desc limit 20")->queryAll();
		$modulo = "";
                $accion = "";
                foreach($command as $cmd)
                {
                    switch ($cmd['accion']) {
                        case 0:
                            $modulo = "login";
                            $accion = "ingreso";
                            break;
                        case -1:
                            $modulo = "login";
                            $accion = "salida";
                            break;                        
                        default:
                            $modulo = $cmd['modulo'];
                            $accion = $cmd['nombre_accion'];
                    }
                    echo "<tr>
                            <td>".$modulo."</td> 
                            <td>".$accion."</td> 
                            <td>".$cmd['nick']."</td>
                            <td>".$cmd['fecha']."</td>
                        </tr>";                    
                }
                
            ?>   
                    
           
            </table>
        </div>        
    </div>

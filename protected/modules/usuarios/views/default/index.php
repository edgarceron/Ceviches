<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
        $this->module->nombre,
);
?>
<div>

  <!-- Nav tabs 
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-home"></span> Home</a></li>
    <li role="presentation"><a href="#nuevo" aria-controls="nuevo" role="tab" data-toggle="tab" class="btn-success"><span class="glyphicon glyphicon-plus"></span> Nuevo Usuario</a></li>    
    <li role="presentation"><a href="#nuevo-perfil" aria-controls="nuevo-perfil" role="tab" data-toggle="tab" class="btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo Perfil</a></li>    
	<li role="presentation"><a href="#nuevo-grupo" aria-controls="nuevo-grupo" role="tab" data-toggle="tab" class="btn-danger"><span class="glyphicon glyphicon-plus"></span> Nuevo Grupo</a></li>
	<li role="presentation"><a href="#nuevo-rol" aria-controls="nuevo-rol" role="tab" data-toggle="tab" class="btn-warning"><span class="glyphicon glyphicon-plus"></span> Nuevo Rol</a></li>
  </ul>
	-->
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="nav-link active btn-primary"><span class="glyphicon glyphicon-home"></span> Home</a></li>
		<li class="nav-item"><a href="#nuevo" aria-controls="nuevo" role="tab" data-toggle="tab" class="nav-link btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo Usuario</a></li>    
		<li class="nav-item"><a href="#nuevo-perfil" aria-controls="nuevo-perfil" role="tab" data-toggle="tab" class="nav-link btn-primary"><span class="glyphicon glyphicon-plus"></span> Nuevo Perfil</a></li>    
	</ul>
	
  <!-- Tab panes -->
  <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="home">
          <br/>
          <div class="tabbable" id="tabs-40080">
                <ul class="nav nav-pills">
                        <li class="nav-item">
                                <a class="nav-link active" href="#panel-640942" data-toggle="tab">Usuarios</a>
                        </li>
                        <li class="nav-item">
                                <a class="nav-link" href="#panel-438434" data-toggle="tab">Perfiles</a>
                        </li>
                </ul>
                <div class="tab-content">
                        <div class="tab-pane active" id="panel-640942">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nick</th>                                                                
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($usuarios as $usuario) { ?>
                                        <tr>
                                            <td><?php echo $usuario->nick ?></td>                    
                                            <td class="text-right">                        
                                                <a href="<?php echo Yii::app()->createUrl('/usuarios/default/view',array('id'=>$usuario->id)) ?>" class="btn btn-warning"><img src="<?php echo Yii::app()->request->baseUrl.'/images/view.png' ?>"/></a> 
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalBorrar"><img src="<?php echo Yii::app()->request->baseUrl.'/images/delete.png' ?>"/></button>
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRestablecer"><img src="<?php echo Yii::app()->request->baseUrl.'/images/lock.png' ?>"/></button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                        </div>
                        <div class="tab-pane" id="panel-438434">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nick</th>                    
                                            <th class="text-right">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($perfiles as $perfil_mostrar) { ?>
                                        <tr>
                                            <td><?php echo $perfil_mostrar->nombre ?></td>                    
                                            <td class="text-right">                        
                                                <a href="<?php echo Yii::app()->createUrl('/usuarios/default/verperfil',array('id'=>$perfil_mostrar->nombre)) ?>" class="btn btn-warning"><span class="glyphicon glyphicon-search"></span></a> 
                                                <a href="<?php echo Yii::app()->createUrl('/usuarios/default/borrarperfil',array('id'=>$perfil_mostrar->nombre)) ?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                        </div>
                </div>
        </div>
          
          
      </div>
      <div role="tabpanel" class="tab-pane" id="nuevo">
          <div class="col-lg-8">
              <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
          </div>                    
      </div>
      <div role="tabpanel" class="tab-pane" id="nuevo-perfil">
          <div class="col-lg-8">
                <?php echo $this->renderPartial('_perfil', array('perfil'=>$perfil)); ?>
              
          </div> 
      </div> 
  </div>
  
<!-- Modal -->
<div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Esta seguro de querer borrar este usuario?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a href="<?php echo Yii::app()->createUrl('/usuarios/default/borrar',array('id'=>$usuario->id)) ?>" class="btn btn-danger">Si</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalRestablecer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Esta seguro de querer restablecer la contraseña de este usuario?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <a href="<?php echo Yii::app()->createUrl('/usuarios/default/restablecer',array('id'=>$usuario->id)) ?>" class="btn btn-danger">Si</a>
      </div>
    </div>
  </div>
</div>

</div>



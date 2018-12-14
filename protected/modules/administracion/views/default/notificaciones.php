<table class="table notificationtr">
	<tbody>

<?php
if($notificaciones != null){
	foreach($notificaciones as $notificacion){	
?>			
		<tr data-href="<?php echo Yii::app()->createUrl('/administracion/default/verPedido', array('id_pedido'=>$notificacion['id_pedido']))?>">
			<td style="white-space: nowrap;">
			<?php echo $notificacion['fecha']?>
			<br>Tienes un nuevo pedido de: 
			<br><?php echo $notificacion['nombre_usuario']?></td>
		</tr>
<?php
	}
}
else{
	echo "No tiene pedidos para mostrar";
}
?>  
	</tbody>
</table>
<script>
	 $(".notificationtr tr").click(function(){
       window.location = $(this).data("href");
     });
</script>

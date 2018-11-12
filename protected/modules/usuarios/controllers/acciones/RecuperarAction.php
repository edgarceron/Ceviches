<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

class RecuperarAction extends CAction
{
    public function run()
    {
		if(isset($_POST['nick'])){
			$nick = trim($_POST['nick']);
		}
		else{
			$nick = '';
		}
		
		if(isset($_POST['email'])){
			$email = trim($_POST['email']);
		}
		else{
			$email = '';
		}
		
		if(isset($_POST['nick']) && isset($_POST['email'])){
			if($nick != '' && $email != ''){
				$criteria = new CDbCriteria;
				$criteria->compare('nick', $nick);
				$criteria->compare('email', $email);
				$usuario = Usuarios::model()->find($criteria);
				
				if($usuario != null){
					if($this->enviarCorreo($usuario)){
						Yii::app()->user->setFlash('success', 'Se ha enviado un correo a ' . $email . ' con los datos para recuperar su contraseña');
					}
					else{
						Yii::app()->user->setFlash('warning', 'Error al enviar el correo');
					}
				}
				else{
					Yii::app()->user->setFlash('warning', 'El usuario y correo ingresado no coinciden con la base de datos');
				}
			}
			else{
				Yii::app()->user->setFlash('warning', 'Diligencie ambos campos para completar la solicitud');
			}
		}
		   
		$this->controller->render('formRecuperar', array('nick' => $nick, 'email' => $email));
    }
	
	
	/**
	 * Envia un correo con el enlacce para recuperación de contraseña
	 * @param $usuario CActiveRecord del usuario
	 * @return bool true si el correo fue enviado, false en caso contrario
	 */
	
	public function enviarCorreo($usuario){
		
		$mail = new PHPMailer;
		if(filter_var($usuario['email'], FILTER_VALIDATE_EMAIL)){
			$codigo = rand(1000000000, 9999999999);
			$nick = $usuario->nick;
			$nombre = $usuario->nombre;
			$id = $usuario->id;
			$estado = 1;
			$this->crearRecuperacion($id, $codigo);
			$adjunto = $this->construirMensaje($nick, $nombre, $codigo);
			
			$mail->IsSMTP();
			$mail->Host = gethostbyname('smtp.gmail.com');
			$mail->Port = 587;
			$mail->CharSet = 'utf-8';
			//$mail->SMTPDebug = 1;
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->SMTPSecure = "tls";
			$mail->SMTPAuth = true;
			$mail->Username = $this->getOpcion('email');
			$mail->Password = base64_decode($this->getOpcion('password'));
			$mail->setFrom($this->getOpcion('email'), 'DonativosNazareno Webmaster');
			$mail->Subject = 'Recuperación de contraseña';
			$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
			$mail->msgHTML($adjunto);
			$mail->AddAddress($usuario['email'], $usuario['nombre']);	
			if(!$mail->send()) {
			  echo '<br>Message was not sent.<br>';
			  echo 'Mailer error: ' . $mail->ErrorInfo;
			  return false;
			} 
			return true;
		}
		return false;
	}
	
	/**
	 * Construye una pagina html con los datos de la recuperación de contraseña
	 * @param $nick Nick del usuario
	 * @param $nombre Nombre del usuario
	 * @param $codigo Codigo de la url generada para la recuperación
	 * @return String con el html de la pagina
	 */
	public function construirMensaje($nick, $nombre, $codigo){
		$url = Yii::app()->createAbsoluteUrl('/usuarios/default/nuevaContra', array('nick' => $nick, 'codigo' => $codigo));
		return $this->controller->renderPartial('plantillaCorreo', array('url' => $url, 'nombre' => $nombre), true);
	}
	
	/**
	 * Crea un registro en la tabla recuperar con la información de la recuperación
	 * @param $id Id del usuario
	 * @param $cod Codigo aleatorio generado para esta recuperación
	 */
	public function crearRecuperacion($id, $cod){
		$this->cancelarRecuperaciones($id);
		$model = new Recuperar;
		$model->url = $cod;
		$model->estado = 1;
		$model->id_usuario = $id;
		$model->save();
	}
	
	/**
	 * Inabilita las recuperaciones antiguas generadas
	 * @param $id Id del usuario
	 */
	public function cancelarRecuperaciones($id){
		$recuperaciones = Recuperar::model()->findAll('id_usuario = ' . $id);
		foreach($recuperaciones as $r){
			$r->estado = 0;
			$r->save();
		}
	}
	
	/**
	 * Adquiere un registro de la table de opciones
	 * @param $parametro String con el nombre del parametro a optener
	 * @return String valor del parametro, null si no existe el parametro
	 */
	public function getOpcion($parametro){
		$record = Opciones::model()->find('opcion = "' . $parametro . '"');
		if($record != null){
			return $record['valor'];
		}
		return null;
	}
	 
}
?>


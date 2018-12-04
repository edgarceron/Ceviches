<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

class NotificarRegistroAction extends CAction
{
    public function run($mail, $nombre)
    {		
		if($this->enviarCorreo($mail, $nombre)){
			Yii::app()->user->setFlash('warning', 'Se envio el correo correctamente');   
		}
		else{
			Yii::app()->user->setFlash('warning', 'No se envio el correo correctamente');   
		}			
		$this->controller->redirect(Yii::app()->user->returnUrl);
    }
	
	
	/**
	 * Envia un correo con el enlacce para recuperación de contraseña
	 * @param $usuario CActiveRecord del usuario
	 * @return bool true si el correo fue enviado, false en caso contrario
	 */
	
	public function enviarCorreo($email, $nombre){
		
		$mail = new PHPMailer;
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			$adjunto = $this->construirMensaje($email, $nombre);
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
			$mail->setFrom($this->getOpcion('email'), 'CevicheYMar Webmaster');
			$mail->Subject = 'Registro ceviche y mar';
			$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
			$mail->msgHTML($adjunto);
			$mail->AddAddress($email, $nombre);	
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
	public function construirMensaje($mail, $nombre){
		return $this->controller->renderPartial('plantillaCorreoRegistro', array('mail' => $mail, 'nombre' => $nombre), true);
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


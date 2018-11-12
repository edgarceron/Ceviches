<?php
class NuevaContraAction extends CAction
{
    public function run()
    {
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$model = Usuarios::model()->findByPk($id);
			$parametros = array('id' => $id);
			
			if(isset($_POST['p']) && isset($_POST['confirmation'])){
				$password = $_POST['p'];
				$confirmation = $_POST['confirmation'];
				$this->llamarRender($model, $password, $confirmation);
			}
			
			$this->controller->render('nuevacontra', array('parametros' => $parametros));
		}
		else if(isset($_GET['nick'])){
			$nick = $_GET['nick'];
			$codigo = $_GET['codigo'];
			$model = Usuarios::model()->find('nick = "' . $nick . '"');
			
			if($model != null){
				$id = $model['id'];
				$recuperar = $this->getRecuperacion($id, $codigo);
				
				if($recuperar != null){
					if($recuperar['estado'] == 1){
						$parametros = array('nick' => $nick, 'codigo' => $codigo);			
						
						if(isset($_POST['p']) && isset($_POST['confirmation'])){
							$password = $_POST['p'];
							$confirmation = $_POST['confirmation'];
							$this->llamarRender($model, $password, $confirmation, $recuperar);
						}
						
						$this->controller->render('nuevacontra', array('parametros' => $parametros));
					}
					else{
						$this->controller->renderText('Esta solicitud de cambio de contraseña ha expirado, solicite otra o póngase en contacto con el administrador de la aplicación');
					}
				}
				else{
					$this->controller->renderText('No se ha generado una recuperación con los datos ingresados.');
				}
			}
			else{
				$this->controller->renderText('No se encuentran usuarios con el nick presentado');
			}
		}
		else{
			$this->controller->renderText('Ups, no deberias estar aqui');
		}
    }
	
	/**
	 * Obtiene la recuperación para el usuario y el codigo especificado
	 * @param $id Id del usuario
	 * @param $codigo Codigo de la recuperación
	 * @return $recuperar Objeto de la clase Recuperar
	 */
	public function getRecuperacion($id_usuario, $codigo){
		$criteria = new CDbCriteria;
		$criteria->compare('id_usuario', $id_usuario);
		$criteria->compare('url', $codigo);
		$recuperar = Recuperar::model()->find($criteria);
		return $recuperar;
	}
	
	/**
	 * Verifica si los datos ingresados para la nueva contraseña son correctos, de ser
	 * así continua al index, en caso contrario escribe un mensaje de error en un flash
	 * @param $password La contraseña ingresada en el formulario
	 * @param $confirmation Confirmación de la contraseña
	 */
	
	public function llamarRender($model, $password, $confirmation, $recuperar = null, $url = ''){
		if($password == $confirmation){
			$password = $_POST['p'];
			$model->password = md5($password);
			$model->restablecer = 0;
			$model->save();
			$mensaje = '';
			if($recuperar != null){
				$recuperar->estado = 0;
				$recuperar->save();
				$mensaje = '?mensaje=1';
				$url = 'site/login';
			}
			else{
				Yii::app()->user->setFlash('success', "La contraseña se cambio satisfactoriamente");
			}
			$this->controller->redirect(Yii::app()->createAbsoluteUrl($url) . $mensaje);
		}
		else{
			Yii::app()->user->setFlash('danger', "La contraseña debe ser igual en ambos campos");
		}
	}
}
?>

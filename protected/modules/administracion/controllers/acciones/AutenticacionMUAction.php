<?php
class AutenticacionMUAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {             
		$client_id = OpcionesTienda::model()->find('descripcion = "client_id_mu"')['valor'];
		$client_secret = OpcionesTienda::model()->find('descripcion = "client_secret_mu"')['valor'];
		
		$parametros = [
			'client_id' => $client_id, 
			'client_secret' => $client_secret,
			'grant_type' => 'client_credentials'
		];
		
		$url = 'https://cerberus.mensajerosurbanos.com/oauth/token';
		$post = json_encode($parametros);
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']); 

		$result=curl_exec ($ch);
		curl_close($ch);
		
		$obj = json_decode($result, true);
		if(isset($obj['access_token'])){
			$opcion = OpcionesTienda::model()->find('descripcion = "access_token_mu"');
			$opcion['valor'] = $obj['access_token'];
			$opcion->save();
			echo 'Token obtenido correctamente';
		}
		else{
			echo 'Ocurrio un error: ';
			echo $obj['error_description'];
		}
    }
}


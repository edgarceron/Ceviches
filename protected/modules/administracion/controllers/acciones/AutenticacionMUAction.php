<?php
class AutenticacionMUAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        $this->controller->render('aut_form',array(
			'client_id' => Opciones::model()->find('opcion = "client_id_mu"')['valor'],
			'client_secret' => Opciones::model()->find('opcion = "client_secret_mu"')['valor'],
        ));
    }
}


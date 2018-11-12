<?php
class VerperfilAction extends CAction
{
    public function run($id)
    {
        $perfil = Perfil::model()->find('nombre = "'.$id.'"');
        $this->controller->render('verperfil',
                                    array(
                                        'perfil'=>$perfil,
                                        ));
    }
}
?>


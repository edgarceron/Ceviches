<?php
class RegistrarpluginAction extends CAction
{
    public function run()
    {        
        $pk = $_POST['plugin'];
        $valor = $_POST['valor'];
        $modulo = Modulos::model()->findByPk($pk);
        if(!empty($modulo))
        {
            if($valor == 1)
            {
                $modulo->estado = 1;
            }
            else
            {
                $modulo->estado = 0;
            }
            $modulo->save();
        }
        else
        {
            $nuevo_modulo = new Modulos;
            $nuevo_modulo->id = $pk;
            $nuevo_modulo->nombre = $pk;
            $nuevo_modulo->estado = 1;
            $nuevo_modulo->fecha_creacion = time();
            $nuevo_modulo->version = 1;
            $nuevo_modulo->desarrollador = "nojuancho@hotmail.com";
            $nuevo_modulo->save();
        }
    }
}
?>



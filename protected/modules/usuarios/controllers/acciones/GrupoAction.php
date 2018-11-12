<?php
class GrupoAction extends CAction
{
    public function run()
    {        
        $grupo = new Grupo;
        $grupo->nombre = $_POST['Grupo']['nombre'];
        if($grupo->save())
        {
            $this->controller->redirect('index');
        }        
    }
}
?>
